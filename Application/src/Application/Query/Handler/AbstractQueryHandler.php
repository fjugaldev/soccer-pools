<?php

namespace App\Application\Query\Handler;

use App\Domain\TournamentPool\Repository\Query\TournamentPoolQueryRepository;

abstract class AbstractQueryHandler
{
    /**
     * @var TournamentPoolQueryRepository
     */
    protected $repository;

    public function __construct(TournamentPoolQueryRepository $repository)
    {

    }

}
