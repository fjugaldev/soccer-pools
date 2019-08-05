<?php

namespace InnovatikLabs\UI\Http\Rest\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;

abstract class AbstractBaseController extends AbstractFOSRestController
{
    const RESULTS_BY_PAGE = 25;
}
