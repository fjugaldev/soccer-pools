<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query\Handler;

use Doctrine\ORM\NonUniqueResultException;
use InnovatikLabs\Bet\TournamentPool\Application\Query\CountTournamentPoolByUserQuery;
use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM\TournamentPoolQueryRepositoryInterface;
use InnovatikLabs\Shared\Domain\Query\Handler\QueryHandlerInterface;

final class CountTournamentPoolByUserQueryHandler implements QueryHandlerInterface
{
    /**
     * @var TournamentPoolQueryRepositoryInterface
     */
    protected $repository;

    public function __construct(TournamentPoolQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CountTournamentPoolByUserQuery $query
     * @return int
     */
    public function __invoke(CountTournamentPoolByUserQuery $query): int
    {
        try {
            return $this->repository->countAllTournamentPoolsOfUser(
                $query->getTournamentId(),
                $query->getUserId()
            );
        } catch (NonUniqueResultException $exception) {
            // TODO: LOG ERROR???
            return 0;
        }
    }
}
