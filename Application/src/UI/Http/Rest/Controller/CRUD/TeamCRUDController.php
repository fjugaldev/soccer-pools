<?php

namespace App\UI\Http\Rest\Controller\CRUD;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route(path="/v1/team", name="api_team_")
 */
class TeamCRUDController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(name="list")
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return new JsonResponse(["Listing Teams"]);
    }

    /**
     * @Rest\Get(path="/{id}", name="read")
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
    }

    /**
     * @Rest\Post(name="create")
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
    }

    /**
     * @Rest\Put(path="/{id}", name="update")
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
    }

    /**
     * @Rest\Delete(path="/{id}", name="delete")
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
    }
}
