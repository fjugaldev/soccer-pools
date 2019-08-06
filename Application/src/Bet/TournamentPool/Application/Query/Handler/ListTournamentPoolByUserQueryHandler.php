<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query\Handler;

use InnovatikLabs\Bet\TournamentPool\Application\Query\ListTournamentByUserPoolQuery;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM\TournamentPoolQueryRepositoryInterface;
use InnovatikLabs\Shared\Domain\Query\Handler\QueryHandlerInterface;

final class ListTournamentPoolByUserQueryHandler implements QueryHandlerInterface
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
     * @param ListTournamentByUserPoolQuery $query
     * @return TournamentPoolView[]
     */
    public function __invoke(ListTournamentByUserPoolQuery $query): ?array
    {
        return $this->repository->allTournamentPoolsOfUserOrNull(
            $query->getTournamentId(),
            $query->getUserId(),
            $query->getPage(),
            $query->getPerPageLimit()
        );
    }
}
