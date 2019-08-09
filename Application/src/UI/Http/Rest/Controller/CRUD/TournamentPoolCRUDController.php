<?php

namespace InnovatikLabs\UI\Http\Rest\Controller\CRUD;

use InnovatikLabs\Bet\TournamentPool\Application\Query\CountTournamentPoolByUserQuery;
use InnovatikLabs\Bet\TournamentPool\Application\Query\ListTournamentByUserPoolQuery;
use InnovatikLabs\Bet\TournamentPool\Application\UseCase\CountTournamentPoolByUserUseCase;
use InnovatikLabs\Bet\TournamentPool\Application\UseCase\ListTournamentPoolByUserUseCase;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPool;
use FOS\RestBundle\Controller\Annotations as Rest;
use InnovatikLabs\Shared\Domain\Exception\MysqlRepositoryCountException;
use InnovatikLabs\Shared\Domain\Exception\MysqlRepositoryListException;
use InnovatikLabs\Shared\Infrastructure\Helper\JsonResponseHelper;
use InnovatikLabs\UI\Http\Rest\Controller\AbstractBaseController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @Rest\Route(path="/v1/tournaments/{tournamentId}/pools", name="api_pools_")
 */
class TournamentPoolCRUDController extends AbstractBaseController
{
    /**
     * @Rest\Get(name="list")
     * @SWG\Response(
     *     response=200,
     *     description="List all Pools for the passed tournament ID owned by the logged user",
     *     @SWG\Schema(type="object",
     *         @SWG\Property(property="data", type="array",
     *             @SWG\Items(type="object",
     *                 @SWG\Property(property="id", type="integer", example="1"),
     *                 @SWG\Property(property="type", type="string", example="TournamentPool"),
     *                 @SWG\Property(property="attributes", ref=@Model(type=TournamentPool::class, groups={"readable"}))
     *             )
     *         )
     *     )
     * )
     *
     * @SWG\Response(
     *     response=401,
     *     description="Unauthorized, you must be logged in before access",
     *     @SWG\Schema(type="object",
     *         @SWG\Property(property="errors", type="array",
     *              @SWG\Items(type="object",
     *                  @SWG\Property(property="status", type="integer", example="401"),
     *                  @SWG\Property(property="code", type="integer", example="Unauthorized"),
     *                  @SWG\Property(property="title", type="string", example="Anonimous User"),
     *                  @SWG\Property(property="detail", type="string", example="You must be logged in before access")
     *              )
     *         )
     *     )
     * )
     *
     * @SWG\Parameter(
     *     name="tournament_id",
     *     in="path",
     *     description="Tournament ID",
     *     required=true,
     *     type="string"
     * )
     *
     * @SWG\Tag(name="TournamentPools")
     * @Security(name="Bearer")
     *
     * @param Request $request
     * @param int $tournamentId
     * @param MessageBusInterface $messageBus
     *
     * @return JsonResponse
     */
    public function list(Request $request, int $tournamentId, MessageBusInterface $messageBus): JsonResponse
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', JsonResponseHelper::DEFAULT_MAX_RESULTS_BY_PAGE);

        try {
            $key = 'count.tournament.'.$tournamentId.'.user.'.$this->getUser()->getId();
            $itemsCount = (int) $this->load($key);
            if (!$itemsCount) {
                $countUserTournamentPoolsUseCase = new CountTournamentPoolByUserUseCase($messageBus);
                $itemsCount = $countUserTournamentPoolsUseCase->execute(
                    CountTournamentPoolByUserQuery::create($tournamentId, $this->getUser()->getId())
                );
                $this->save($key, $itemsCount, 300);
            }
        } catch (MysqlRepositoryCountException $exception) {
            return JsonResponse::create($exception->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $key = 'list.tournament.'.$tournamentId.'.user.'.$this->getUser()->getId();
            $items = $this->load($key, true);
            if (!$items) {
                $useCase = new ListTournamentPoolByUserUseCase($messageBus);
                $items = $useCase->execute(
                    ListTournamentByUserPoolQuery::create(
                        $tournamentId,
                        $this->getUser()->getId(),
                        $page,
                        $limit
                    )
                );
                $this->save($key, $items, 300, true);
                dump('generado cache nuevo');
            }
        } catch (MysqlRepositoryListException $exception) {
            return JsonResponse::create($exception->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }

        return JsonResponse::create(
            [
                'type' => 'TournamentPool',
                'data' => [
                    'items' => $items,
                    'itemsCount' => $itemsCount,
                ],
            ]
        );
    }

    /**
     * @Rest\Get(path="/{id}", name="read")
     *
     * @SWG\Parameter(
     *     name="tournament_id",
     *     in="path",
     *     description="Tournament ID",
     *     required=true,
     *     type="string"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Pool ID",
     *     required=true,
     *     type="string"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Read a Tournament Pool by his ID",
     *     @Model(type=TournamentPool::class, groups={"readable"})
     * )
     *
     * @SWG\Tag(name="TournamentPools")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        return new JsonResponse(
            [
                'id' => 1,
                'name' => "Team 1",
            ]
        );
    }

    /**
     * @Rest\Post(name="create")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Create a pool for the passed tournament ID",
     *     @Model(type=TournamentPool::class, groups={"readable"})
     * )
     *
     * @SWG\Tag(name="TournamentPools")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
    }

    /**
     * @Rest\Put(path="/{id}", name="update")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update a Pool info by his ID",
     *     @Model(type=TournamentPool::class, groups={"readable"})
     * )
     *
     * @SWG\Tag(name="TournamentPools")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
    }

    /**
     * @Rest\Delete(path="/{id}", name="delete")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Delete a Pool by his ID"
     * )
     *
     * @SWG\Tag(name="TournamentPools")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
    }
}
