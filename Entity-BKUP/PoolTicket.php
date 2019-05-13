<?php

namespace AppRoot\Shared\Infrastructure\Entity;

use Doctrine\ORM\MAppRooting as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class PoolTicket extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var TournamentPool
     * @ORM\ManyToOne(targetEntity="TournamentPool", inversedBy="poolTickets")
     * @ORM\JoinColumn(name="pool_id", referencedColumnName="id")
     *
     */
    private $pool;

    /**
     * @var Match
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    private $match;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $visitorScore;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $homeScore;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @return TournamentPool
     */
    public function getPool(): TournamentPool
    {
        return $this->pool;
    }

    /**
     * @param TournamentPool $pool
     * @return PoolTicket
     */
    public function setPool(TournamentPool $pool): PoolTicket
    {
        $this->pool = $pool;

        return $this;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @param Match $match
     * @return PoolTicket
     */
    public function setMatch(Match $match): PoolTicket
    {
        $this->match = $match;

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
     * @return PoolTicket
     */
    public function setVisitorScore(int $visitorScore): PoolTicket
    {
        $this->visitorScore = $visitorScore;

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
     * @return PoolTicket
     */
    public function setHomeScore(int $homeScore): PoolTicket
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * @return User
     */
    public function getPlayer(): User
    {
        return $this->player;
    }

    /**
     * @param User $player
     * @return PoolTicket
     */
    public function setPlayer(User $player): PoolTicket
    {
        $this->player = $player;

        return $this;
    }
}