<?php

namespace App\Api\Group\Infrastructure\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends FOSRestBundle
{
    /**
     * @Rest\Get(name="test_group_action", path="/test/group")
     * @param Request $request
     * @return JsonResponse
     */
    public function testAction(Request $request): JsonResponse
    {
        return new JsonResponse(["OK"]);
    }

}