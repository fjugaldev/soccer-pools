<?php

namespace InnovatikLabs\Shared\Domain\Query\UseCase;

use InnovatikLabs\Shared\Domain\Query\QueryInterface;

interface UseCaseQueryInterface
{
    /**
     * @param QueryInterface $queryMessage
     */
    public function execute(QueryInterface $queryMessage);
}