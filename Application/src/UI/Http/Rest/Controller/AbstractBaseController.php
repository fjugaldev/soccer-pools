<?php

namespace InnovatikLabs\UI\Http\Rest\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;

abstract class AbstractBaseController extends AbstractFOSRestController
{
    const DEFAULT_MAX_RESULTS_BY_PAGE = 25;

    public static function totalPages(int $itemsCount, int $limit): int
    {
        return ceil($itemsCount / $limit);
    }
}
