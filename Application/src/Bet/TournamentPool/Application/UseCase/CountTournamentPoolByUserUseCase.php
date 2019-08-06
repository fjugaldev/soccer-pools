<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\UseCase;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use InnovatikLabs\Shared\Domain\Query\UseCase\UseCaseQueryInterface;
use InnovatikLabs\Shared\Infrastructure\UseCase\BaseUseCase;

class CountTournamentPoolByUserUseCase extends BaseUseCase implements UseCaseQueryInterface
{
    /**
     * @param QueryInterface $queryMessage
     *
     * @return int
     */
    public function execute(QueryInterface $queryMessage): int
    {
        return $this->handleMessage($queryMessage);
    }
}