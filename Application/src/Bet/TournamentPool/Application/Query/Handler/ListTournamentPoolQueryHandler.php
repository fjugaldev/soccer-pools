<?php

namespace InnovatikLabs\Bet\TournamentPool\Application\Query\Handler;

use InnovatikLabs\Bet\TournamentPool\Application\Query\ListTournamentPoolQuery;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Shared\Domain\Query\Handler\QueryHandlerInterface;

class ListTournamentPoolQueryHandler extends AbstractQueryHandler implements QueryHandlerInterface
{
    /**
     * @param ListTournamentPoolQuery $listTournamentPoolQuery
     * @return TournamentPoolView[]
     */
    public function __invoke(ListTournamentPoolQuery $listTournamentPoolQuery): array
    {
        return [
            "tournamentId" => $listTournamentPoolQuery->getTournamentId(),
            "userId" => $listTournamentPoolQuery->getUserId(),
            "pools" => [
                0 => [
                    'id' => 1,
                    'name' => 'Name 1',
                ],
                1 => [
                    'id' => 2,
                    'name' => 'Name 2',
                ],
                2 => [
                    'id' => 3,
                    'name' => 'Name 3',
                ],
                3 => [
                    'id' => 4,
                    'name' => 'Name 4',
                ],
            ],
        ];
    }
}
