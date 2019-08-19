<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\UseCase;

use InnovatikLabs\Shared\Domain\Exception\MysqlRepositoryCountException;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use InnovatikLabs\Shared\Domain\Query\UseCase\UseCaseQueryInterface;
use InnovatikLabs\Shared\Infrastructure\UseCase\BaseUseCase;

class CountTournamentPoolByUserUseCase extends BaseUseCase implements UseCaseQueryInterface
{
    /**
     * @param QueryInterface $queryMessage
     *
     * @return int
     *
     * @throws MysqlRepositoryCountException
     */
    public function execute(QueryInterface $queryMessage): int
    {
        try {
            $key = 'count.tournament.'.$queryMessage->getTournamentId().'.user.'.$queryMessage->getUserId();
            $itemsCount = (int)$this->load($key);
            if (!$itemsCount) {
                $itemsCount = $this->handleMessage($queryMessage);
                $this->save($key, $itemsCount, self::TTL_ONE_DAY);
            }

            return $itemsCount;
        } catch (\Exception $exception) {
            throw new MysqlRepositoryCountException(
                "An error has occurred trying to count all tournament pools of user"
            );
        }
    }
}
