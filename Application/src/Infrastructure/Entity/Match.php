<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Match extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="visitor_id", referencedColumnName="id")
     */
    private $visitor;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $visitorScore;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="home_id", referencedColumnName="id")
     */
    private $home;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $homeScore;

    /**
     * @var Tournament
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="matches")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return Team
     */
    public function getVisitor(): Team
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
    public function getVisitorScore(): int
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
    public function getHome(): Team
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
    public function getHomeScore(): int
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
    public function getTournament(): Tournament
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
    public function getDate(): \DateTime
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
}
