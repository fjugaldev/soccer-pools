<?php

declare(strict_types=1);

namespace InnovatikLabs\Shared\Domain\Query\Exception;

class NotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Resource not found');
    }
}
