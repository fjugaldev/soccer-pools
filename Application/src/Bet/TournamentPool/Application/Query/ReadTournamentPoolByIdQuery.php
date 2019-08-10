<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query;

use InnovatikLabs\Shared\Domain\Query\QueryInterface;

class ReadTournamentPoolByIdQuery implements QueryInterface
{
    /**
     * @var int
     */
    private $tournamentId;
    private $userId;
    private $poolId;


}