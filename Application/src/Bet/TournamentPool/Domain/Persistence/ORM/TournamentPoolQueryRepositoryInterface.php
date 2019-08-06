<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use Ramsey\Uuid\UuidInterface;

interface TournamentPoolQueryRepositoryInterface
{
    /**
     * @param string $tournamentId
     * @param UuidInterface $ownerId
     * @param int $page
     * @param int $limit
     * @return TournamentPoolView[]|null
     */
    public function allTournamentPoolsOfUserOrNull(string $tournamentId, UuidInterface $ownerId, int $page, int $limit): ?array;

    /**
     * @param string $tournamentId
     * @param UuidInterface $ownerId
     * @return int
     */
    public function countAllTournamentPoolsOfUser(string $tournamentId, UuidInterface $ownerId): int;
}
