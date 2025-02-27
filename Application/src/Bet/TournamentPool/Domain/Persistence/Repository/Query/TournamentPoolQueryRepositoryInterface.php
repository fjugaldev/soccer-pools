<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Persistence\Repository\Query;

interface TournamentPoolQueryRepositoryInterface
{
    /**
     * @param int $page
     * @param int $perPage
     *
//     * @return ProductView[]
     */
    public function fetchAll(int $page, int $perPage): array;
}