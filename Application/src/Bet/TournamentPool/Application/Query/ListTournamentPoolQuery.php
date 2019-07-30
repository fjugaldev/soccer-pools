<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query;

use InnovatikLabs\Shared\Domain\Query\QueryInterface;

class ListTournamentPoolQuery implements QueryInterface
{
    /**
     * @var int
     */
    protected $tournamentId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @param int $tournamentId
     * @param int $userId
     */
    public function __construct(int $tournamentId, int $userId)
    {
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTournamentId(): int
    {
        return $this->tournamentId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
