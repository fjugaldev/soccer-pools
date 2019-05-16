<?php

namespace App\Api\Federation\Infrastructure\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FederationController extends FOSRestBundle
{
    /**
     * @Rest\Get(name="test_federation_action", path="/test/federation")
     * @param Request $request
     * @return JsonResponse
     */
    public function testAction(Request $request): JsonResponse
    {
        return new JsonResponse(["OK"]);
    }

}