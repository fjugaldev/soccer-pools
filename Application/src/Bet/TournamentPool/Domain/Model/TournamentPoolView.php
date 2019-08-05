<?php

namespace InnovatikLabs\Bet\TournamentPool\Domain\Model;

use InnovatikLabs\Account\User\Domain\Model\User;
use InnovatikLabs\Game\Tournament\Domain\Model\Tournament;

class TournamentPoolView implements \JsonSerializable
{
    /**
     * @var string
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

    /**
     * @param string $id
     * @param Tournament $tournament
     * @param string $name
     * @param string $description
     * @param bool $private
     * @param User $owner
     * @param int $maxPlayers
     * @param int $hitVictoryPoints
     * @param int $hitTiePoints
     * @param int $hitScorePoints
     * @param int $hitHomeScorePoints
     * @param int $hitVisitorScorePoints
     */
    private function __construct(
        string $id,
        Tournament $tournament,
        string $name,
        string $description,
        bool $private,
        User $owner,
        int $maxPlayers,
        int $hitVictoryPoints,
        int $hitTiePoints,
        int $hitScorePoints,
        int $hitHomeScorePoints,
        int $hitVisitorScorePoints
    ) {
        $this->id = $id;
        $this->tournament = $tournament;
        $this->name = $name;
        $this->description = $description;
        $this->private = $private;
        $this->owner = $owner;
        $this->maxPlayers = $maxPlayers;
        $this->hitVictoryPoints = $hitVictoryPoints;
        $this->hitTiePoints = $hitTiePoints;
        $this->hitScorePoints = $hitScorePoints;
        $this->hitHomeScorePoints = $hitHomeScorePoints;
        $this->hitVisitorScorePoints = $hitVisitorScorePoints;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'tournament' => $this->tournament->getName(),
            'name' => $this->name,
            'description' => $this->description,
            'private' => $this->private,
            'owner' => $this->owner->getFirstName().' '.$this->owner->getLastName(),
            'maxPlayers' => $this->maxPlayers,
            'hitVictoryPoints' => $this->hitVictoryPoints,
            'hitTiePoints' => $this->hitTiePoints,
            'hitScorePoints' => $this->hitScorePoints,
            'hitHomeScorePoints' => $this->hitHomeScorePoints,
            'hitVisitorScorePoints' => $this->hitVisitorScorePoints,
        ];
    }

    /**
     * @param TournamentPool $tournamentPool
     * @return TournamentPoolView
     */
    public static function createFromModel(TournamentPool $tournamentPool): TournamentPoolView
    {
        return new self(
            $tournamentPool->getId()->toString(),
            $tournamentPool->getTournament(),
            $tournamentPool->getName(),
            $tournamentPool->getDescription(),
            $tournamentPool->isPrivate(),
            $tournamentPool->getOwner(),
            $tournamentPool->getMaxPlayers(),
            $tournamentPool->getHitVictoryPoints(),
            $tournamentPool->getHitTiePoints(),
            $tournamentPool->getHitScorePoints(),
            $tournamentPool->getHitHomeScorePoints(),
            $tournamentPool->getHitVisitorScorePoints()
        );
    }
}