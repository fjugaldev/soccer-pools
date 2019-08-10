<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use Ramsey\Uuid\UuidInterface;

interface TournamentPoolQueryRepositoryInterface
{
    /**
     * @param UuidInterface $tournamentId
     * @param UuidInterface $ownerId
     * @param int $page
     * @param int $limit
     * @return TournamentPoolView[]|null
     */
    public function allTournamentPoolsOfUserOrNull(UuidInterface $tournamentId, UuidInterface $ownerId, int $page, int $limit): ?array;

    /**
     * @param UuidInterface $tournamentId
     * @param UuidInterface $ownerId
     * @return int
     */
    public function countAllTournamentPoolsOfUser(UuidInterface $tournamentId, UuidInterface $ownerId): int;
}
