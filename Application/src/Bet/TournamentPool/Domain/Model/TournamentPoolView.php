<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Model;

use InnovatikLabs\Account\User\Domain\Model\User;
use InnovatikLabs\Game\Tournament\Domain\Model\Tournament;

class TournamentPoolView
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Tournament
     */
    private $tournament;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $private;

    /**
     * @var User
     */
    private $owner;

    /**
     * @var int
     */
    private $maxPlayers;

    /**
     * @var int
     */
    private $hitVictoryPoints;

    /**
     * @var int
     */
    private $hitTiePoints;

    /**
     * @var int
     */
    private $hitScorePoints;

    /**
     * @var int
     */
    private $hitHomeScorePoints;

    /**
     * @var int
     */
    private $hitVisitorScorePoints;
}