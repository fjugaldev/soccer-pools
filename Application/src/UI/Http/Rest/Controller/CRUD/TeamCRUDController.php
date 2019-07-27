<?php

namespace InnovatikLabs\UI\Http\Rest\Controller\CRUD;

use InnovatikLabs\Domain\Team\ValueObject\Team;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route(path="/v1/team", name="api_team_")
 */
class TeamCRUDController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(name="list")
     * @SWG\Response(
     *     response=200,
     *     description="List all Teams",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Team::class, groups={"readable"}))
     *     )
     * )
     *
     * @SWG\Response(
     *     response=404,
     *     description="Bad request"
     * )
     *
     * @SWG\Tag(name="Team")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return new JsonResponse(["Listing Teams"]);
    }

    /**
     * @Rest\Get(path="/{id}", name="read")
     * @SWG\Response(
     *     response=200,
     *     description="Read a Team by his ID",
     *     @Model(type=Team::class, groups={"readable"})
     * )
     * @SWG\Tag(name="Team")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        return new JsonResponse([
            'id' => 1,
            'name' => "Team 1"
        ]);
    }

    /**
     * @Rest\Post(name="create")
     * * @SWG\Response(
     *     response=200,
     *     description="Create a Team",
     *     @Model(type=Team::class, groups={"readable"})
     * )
     * @SWG\Tag(name="Team")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
    }

    /**
     * @Rest\Put(path="/{id}", name="update")
     * * @SWG\Response(
     *     response=200,
     *     description="Update a Team info",
     *     @Model(type=Team::class, groups={"readable"})
     * )
     * @SWG\Tag(name="Team")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
    }

    /**
     * @Rest\Delete(path="/{id}", name="delete")
     * * @SWG\Response(
     *     response=200,
     *     description="Delete a Team"
     * )
     * @SWG\Tag(name="Team")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
    }
}
