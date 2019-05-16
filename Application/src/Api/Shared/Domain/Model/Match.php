<?php

namespace App\Api\Shared\Domain\Model;

class Match extends BaseEntity
{
    /**
     * @var int
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
}
