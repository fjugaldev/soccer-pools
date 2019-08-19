<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\UseCase;

use InnovatikLabs\Bet\TournamentPool\Application\Query\ListTournamentPoolByUserQuery;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Shared\Domain\Exception\MysqlRepositoryListException;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use InnovatikLabs\Shared\Domain\Query\UseCase\UseCaseQueryInterface;
use InnovatikLabs\Shared\Infrastructure\UseCase\BaseUseCase;
use Ramsey\Uuid\Uuid;

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
            $key = 'list.tournament.'.$queryMessage->getTournamentId().'.user.'.$queryMessage->getUserId();
            $items = $this->load($key, true);
            if (!$items) {
                $items = $this->handleMessage($queryMessage);
                $this->save($key, $items, self::TTL_ONE_DAY, true);
            }
            return $items;
        } catch (\Exception $exception) {
            throw new MysqlRepositoryListException(
                "An error has occurred trying to list all tournament pools of user"
            );
        }
    }
}
