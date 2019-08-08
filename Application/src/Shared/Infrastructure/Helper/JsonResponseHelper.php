<?php


namespace InnovatikLabs\Shared\Infrastructure\Helper;

use Symfony\Component\HttpFoundation\Request;

abstract class JsonResponseHelper
{
    const DEFAULT_MAX_RESULTS_BY_PAGE = 25;

    /**
     * @param string $type
     * @param Request $request
     * @param array $items
     * @param int $itemsCount
     * @return array
     */
    public static function generateResponseBody(string $type, Request $request, array $items, int $itemsCount): array
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', self::DEFAULT_MAX_RESULTS_BY_PAGE);
        $uri = $request->getUri();
        $totalPages = self::totalPages($itemsCount, $limit);
        $selfPageLink = $uri;
        $firstPageLink = "{$uri}?page=1&limit={$limit}";
        $prevPageLink = "{$uri}?page=".$page === 1 ? $page : ($page - 1)."&limit={$limit}";
        $nextPageLink = "{$uri}?page=".($page + 1)."&limit={$limit}";
        $lastPageLink = "{$uri}?page={$totalPages}&limit={$limit}";

        return [
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
        ];
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