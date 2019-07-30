<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;

interface TournamentPoolQueryRepositoryInterface
{
    /**
     * @param int $page
     * @param int $perPage
     *
     * @return TournamentPoolView[]
     */
    public function fetchAll(int $page, int $perPage): array;
}