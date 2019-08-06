<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query;

use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use Ramsey\Uuid\UuidInterface;

final class CountTournamentPoolByUserQuery implements QueryInterface
{
    /**
     * @var int
     */
    protected $tournamentId;

    /**
     * @var UuidInterface
     */
    protected $userId;

    /**
     * @param int $tournamentId
     * @param UuidInterface $userId
     */
    private function __construct(int $tournamentId, UuidInterface $userId)
    {
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
    }

    /**
     * @param int $tournamentId
     * @param UuidInterface $userId
     * @return CountTournamentPoolByUserQuery
     */
    public static function create(int $tournamentId, UuidInterface $userId): CountTournamentPoolByUserQuery
    {
        return new self($tournamentId, $userId);
    }

    /**
     * @return int
     */
    public function getTournamentId(): int
    {
        return $this->tournamentId;
    }

    /**
     * @return UuidInterface
     */
    public function getUserId(): UuidInterface
    {
        return $this->userId;
    }
}
