<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query;

use InnovatikLabs\Shared\Domain\Query\AbstractPageableQuery;
use InnovatikLabs\Shared\Domain\Query\QueryInterface;
use Ramsey\Uuid\UuidInterface;

final class ListTournamentPoolByUserQuery extends AbstractPageableQuery implements QueryInterface
{
    /**
     * @var UuidInterface
     */
    private $tournamentId;

    /**
     * @var UuidInterface
     */
    private $userId;

    /**
     * @param UuidInterface $tournamentId
     * @param UuidInterface $userId
     * @param $page
     * @param $perPageLimit
     */
    private function __construct(UuidInterface $tournamentId, UuidInterface $userId, $page, $perPageLimit)
    {
        $this->page = $page;
        $this->perPageLimit = $perPageLimit;
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
    }

    /**
     * @param UuidInterface $tournamentId
     * @param UuidInterface $userId
     * @param $page
     * @param $perPageLimit
     * @return ListTournamentPoolByUserQuery
     */
    public static function create(UuidInterface $tournamentId, UuidInterface $userId, int $page, int $perPageLimit): ListTournamentPoolByUserQuery
    {
        return new self($tournamentId, $userId, $page, $perPageLimit);
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
