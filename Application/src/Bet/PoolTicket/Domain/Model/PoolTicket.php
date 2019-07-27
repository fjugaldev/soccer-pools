<?php

namespace InnovatikLabs\Bet\PoolTicket\Domain\Model;

use InnovatikLabs\Game\Match\Domain\Model\Match;
use InnovatikLabs\Shared\Domain\Model\BaseEntity;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPool;
use InnovatikLabs\Account\User\Domain\Model\User;

class PoolTicket extends BaseEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TournamentPool
     */
    private $pool;

    /**
     * @var Match
     */
    private $match;

    /**
     * @var int
     */
    private $visitorScore;

    /**
     * @var int
     */
    private $homeScore;

    /**
     * @var User
     */
    private $player;

    /**
     * @return null|TournamentPool
     */
    public function getPool(): ?TournamentPool
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
     * @return null|Match
     */
    public function getMatch(): ?Match
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
     * @return null|int
     */
    public function getVisitorScore(): ?int
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
     * @return null|int
     */
    public function getHomeScore(): ?int
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
     * @return null|User
     */
    public function getPlayer(): ?User
    {
        return $this->player;
    }

    /**
     * @param User $player
     * @return null|PoolTicket
     */
    public function setPlayer(User $player): ?PoolTicket
    {
        $this->player = $player;

        return $this;
    }
}
