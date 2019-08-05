<?php
namespace InnovatikLabs\Bet\TournamentPool\Infrastructure\Persistence\Adapter;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPool;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;

class TournamentPoolAdapter
{
    /**
     * @param TournamentPool $tournamentPool
     * @return TournamentPoolView
     */
    public function map(TournamentPool $tournamentPool): TournamentPoolView
    {
        return TournamentPoolView::createFromModel($tournamentPool);
    }
}