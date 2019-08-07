<?php

namespace InnovatikLabs\UI\Http\Rest\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractBaseController extends AbstractFOSRestController
{
    const DEFAULT_MAX_RESULTS_BY_PAGE = 25;

    public static function generateJsonResponse(
        string $type,
        array $items,
        int $itemsCount,
        string $uri,
        int $page,
        int $limit
    ): JsonResponse {
        $totalPages = self::totalPages($itemsCount, $limit);
        $selfPageLink = $uri;
        $firstPageLink = "{$uri}?page=1&limit={$limit}";
        $prevPageLink = "{$uri}?page=".$page === 1 ? $page : ($page - 1)."&limit={$limit}";
        $nextPageLink = "{$uri}?page=".($page + 1)."&limit={$limit}";
        $lastPageLink = "{$uri}?page={$totalPages}&limit={$limit}";

        return JsonResponse::create([
            'data' => [
                'type' => $type,
                'items' => $items,
            ],
            'links' => [
                'self' => $selfPageLink,
                'first' => $firstPageLink,
                'prev' => $prevPageLink,
                'next' => $nextPageLink,
                'last' => $lastPageLink,
            ],
            'meta' => [
                'currentPage' => $page,
                'ItemsPerPage' => $limit,
                'totalPages' => $totalPages,
            ],
        ]);
    }

    /**
     * @param int $itemsCount
     * @param int $limit
     * @return int
     */
    public static function totalPages(int $itemsCount, int $limit): int
    {
        return ceil($itemsCount / $limit);
    }
}
