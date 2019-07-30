<?php

namespace InnovatikLabs\Shared\Domain\Command\UseCase;

use InnovatikLabs\Shared\Domain\Command\CommandInterface;

interface UseCaseCommandInterface
{
    /**
     * @param CommandInterface $queryMessage
     */
    public function execute(CommandInterface $queryMessage);
}