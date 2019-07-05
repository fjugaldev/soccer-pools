<?php

namespace App\UI\Http\Rest\Controller;

use App\Domain\Team\ValueObject\Team;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/health/check", name="health_check")
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository(Team::class)->findAll();

        return new JsonResponse($teams);
    }
}
