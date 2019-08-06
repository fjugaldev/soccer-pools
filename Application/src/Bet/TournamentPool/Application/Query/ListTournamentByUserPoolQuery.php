<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query;

use InnovatikLabs\Shared\Domain\Query\AbstractPageableQuery;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use Ramsey\Uuid\UuidInterface;

final class ListTournamentByUserPoolQuery extends AbstractPageableQuery implements QueryInterface
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
     * @param $page
     * @param $perPageLimit
     */
    private function __construct(int $tournamentId, UuidInterface $userId, $page, $perPageLimit)
    {
        $this->page = $page;
        $this->perPageLimit = $perPageLimit;
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
    }

    /**
     * @param int $tournamentId
     * @param UuidInterface $userId
     * @param $page
     * @param $perPageLimit
     * @return ListTournamentByUserPoolQuery
     */
    public static function create(int $tournamentId, UuidInterface $userId, int $page, int $perPageLimit): ListTournamentByUserPoolQuery
    {
        return new self($tournamentId, $userId, $page, $perPageLimit);
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
