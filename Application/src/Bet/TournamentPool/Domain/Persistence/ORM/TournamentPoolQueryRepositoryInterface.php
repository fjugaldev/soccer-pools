<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use Ramsey\Uuid\UuidInterface;

interface TournamentPoolQueryRepositoryInterface
{
    /**
     * @param string $tournamentId
     * @param UuidInterface $ownerId
     * @return TournamentPoolView[]
     */
    public function allOfUserId(string $tournamentId, UuidInterface $ownerId): array;
}