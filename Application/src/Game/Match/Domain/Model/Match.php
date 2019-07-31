<?php

namespace InnovatikLabs\Game\Match\Domain\Model;

use InnovatikLabs\Game\Group\Domain\Model\Group;
use InnovatikLabs\Shared\Domain\Model\BaseEntity;
use InnovatikLabs\Game\Team\Domain\Model\Team;
use InnovatikLabs\Game\Tournament\Domain\Model\Tournament;
use InnovatikLabs\Game\TournamentPhase\Domain\Model\TournamentPhase;
use Ramsey\Uuid\UuidInterface;

class Match extends BaseEntity
{
    /**
     * @var UuidInterface
     */
    protected $id;

    /**
     * @var Team
     */
    private $visitor;

    /**
     * @var int
     */
    private $visitorScore;

    /**
     * @var Team
     */
    private $home;

    /**
     * @var int
     */
    private $homeScore;

    /**
     * @var Tournament
     */
    private $tournament;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var Group
     */
    private $group;

    /**
     * @var TournamentPhase
     */
    private $phase;

    /**
     * @var boolean
     */
    private $started;

    /**
     * @var boolean
     */
    private $ended;

    /**
     * @return Team
     */
    public function getVisitor(): ?Team
    {
        return $this->visitor;
    }

    /**
     * @param Team $visitor
     * @return Match
     */
    public function setVisitor(Team $visitor): Match
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * @return int
     */
    public function getVisitorScore(): ?int
    {
        return $this->visitorScore;
    }

    /**
     * @param int $visitorScore
     * @return Match
     */
    public function setVisitorScore(int $visitorScore): Match
    {
        $this->visitorScore = $visitorScore;

        return $this;
    }

    /**
     * @return Team
     */
    public function getHome(): ?Team
    {
        return $this->home;
    }

    /**
     * @param Team $home
     * @return Match
     */
    public function setHome(Team $home): Match
    {
        $this->home = $home;

        return $this;
    }

    /**
     * @return int
     */
    public function getHomeScore(): ?int
    {
        return $this->homeScore;
    }

    /**
     * @param int $homeScore
     * @return Match
     */
    public function setHomeScore(int $homeScore): Match
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * @return Tournament
     */
    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    /**
     * @param Tournament $tournament
     * @return Match
     */
    public function setTournament(Tournament $tournament): Match
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Match
     */
    public function setDate(\DateTime $date): Match
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return Match
     */
    public function setGroup(Group $group): Match
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return TournamentPhase
     */
    public function getPhase(): ?TournamentPhase
    {
        return $this->phase;
    }

    /**
     * @param TournamentPhase $phase
     * @return Match
     */
    public function setPhase(TournamentPhase $phase): Match
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStarted(): bool
    {
        return $this->started;
    }

    /**
     * @param bool $started
     * @return Match
     */
    public function setStarted(bool $started): Match
    {
        $this->started = $started;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnded(): bool
    {
        return $this->ended;
    }

    /**
     * @param bool $ended
     * @return Match
     */
    public function setEnded(bool $ended): Match
    {
        $this->ended = $ended;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '[ '. $this->phase->getName() .' ] - ( '. $this->date->format('Y-m-d') .' ) ' . $this->home->getName() . ' vs ' . $this->visitor->getName();
    }
}
