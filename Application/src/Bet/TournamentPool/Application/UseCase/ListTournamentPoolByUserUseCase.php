<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\UseCase;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Shared\Domain\Exception\MysqlRepositoryListException;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use InnovatikLabs\Shared\Domain\Query\UseCase\UseCaseQueryInterface;
use InnovatikLabs\Shared\Infrastructure\UseCase\BaseUseCase;

class ListTournamentPoolByUserUseCase extends BaseUseCase implements UseCaseQueryInterface
{
    /**
     * @param QueryInterface $queryMessage
     *
     * @return TournamentPoolView[]
     * @throws MysqlRepositoryListException
     */
    public function execute(QueryInterface $queryMessage): array
    {
        try {
            return $this->handleMessage($queryMessage);
        } catch (\Exception $exception) {
            throw new MysqlRepositoryListException(
                "An error has occurred trying to list all tournament pools of user"
            );
        }
    }
}