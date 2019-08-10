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
     * @param UuidInterface $tournamentId
     * @param UuidInterface $userId
     */
    private function __construct(UuidInterface $tournamentId, UuidInterface $userId)
    {
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
    }

    /**
     * @param UuidInterface $tournamentId
     * @param UuidInterface $userId
     * @return CountTournamentPoolByUserQuery
     */
    public static function create(UuidInterface $tournamentId, UuidInterface $userId): CountTournamentPoolByUserQuery
    {
        return new self($tournamentId, $userId);
    }

    /**
     * @return UuidInterface
     */
    public function getTournamentId(): UuidInterface
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
