<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query\Handler;

use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM\TournamentPoolQueryRepositoryInterface;

abstract class AbstractQueryHandler
{
    /**
     * @var TournamentPoolQueryRepositoryInterface
     */
    protected $repository;

    public function __construct(TournamentPoolQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
