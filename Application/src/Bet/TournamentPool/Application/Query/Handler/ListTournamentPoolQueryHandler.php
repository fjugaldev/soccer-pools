<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query\Handler;

use InnovatikLabs\Bet\TournamentPool\Application\Query\ListTournamentPoolQuery;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM\TournamentPoolQueryRepositoryInterface;
use InnovatikLabs\Shared\Domain\Query\Handler\QueryHandlerInterface;

class ListTournamentPoolQueryHandler implements QueryHandlerInterface
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
     * @param ListTournamentPoolQuery $query
     * @return TournamentPoolView[]
     */
    public function __invoke(ListTournamentPoolQuery $query): array
    {
        return $this->repository->allOfUserId($query->getTournamentId(), $query->getUserId());
    }
}
