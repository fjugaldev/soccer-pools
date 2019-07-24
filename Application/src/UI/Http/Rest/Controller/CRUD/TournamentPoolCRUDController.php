<?php

namespace App\UI\Http\Rest\Controller\CRUD;

use App\Application\Query\ListTournamentPoolQuery;
use App\Domain\TournamentPool\ValueObject\TournamentPool;
use App\UI\Http\Rest\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Json;

/**
 * @Rest\Route(path="/v1/tournaments/{tournamentId}/pools", name="api_pools_")
 */
class TournamentPoolCRUDController extends BaseController
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
     * @param int $tournamentId
     * @return JsonResponse
     */
    public function list(int $tournamentId): JsonResponse
    {
        $data = $this->handleMessage(new ListTournamentPoolQuery($tournamentId, $this->getUser()->getId()));

        return new JsonResponse($data);
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
