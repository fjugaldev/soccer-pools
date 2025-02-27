<?php

namespace AppRoot\Shared\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\MAppRooting as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class TournamentPool extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var Tournament
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="pools")
     * @ORM\JoinColumn(name="tournament_it", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $private;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accessCode;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="owningPools")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $maxPlayers;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $hitVictoryPoints;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $hitTiePoints;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $hitScorePoints;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $hitHomeScorePoints;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $hitVisitorScorePoints;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="User", inversedBy="playingPools")
     * @ORM\JoinTable(name="tournament_pool_players")
     */
    private $players;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="PoolTicket", mAppRootedBy="pool")
     */
    private $poolTickets;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->poolTickets = new ArrayCollection();
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
     * @return TournamentPool
     */
    public function setTournament(Tournament $tournament): TournamentPool
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TournamentPool
     */
    public function setName(string $name): TournamentPool
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return TournamentPool
     */
    public function setDescription(string $description): TournamentPool
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPrivate(): ?bool
    {
        return $this->private;
    }

    /**
     * @param bool $private
     * @return TournamentPool
     */
    public function setPrivate(bool $private): TournamentPool
    {
        $this->private = $private;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessCode(): ?string
    {
        return $this->accessCode;
    }

    /**
     * @param string $accessCode
     * @return TournamentPool
     */
    public function setAccessCode(string $accessCode): TournamentPool
    {
        $this->accessCode = $accessCode;

        return $this;
    }

    /**
     * @return User
     */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return TournamentPool
     */
    public function setOwner(User $owner): TournamentPool
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    /**
     * @param int $maxPlayers
     * @return TournamentPool
     */
    public function setMaxPlayers(int $maxPlayers): TournamentPool
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitVictoryPoints(): ?int
    {
        return $this->hitVictoryPoints;
    }

    /**
     * @param int $hitVictoryPoints
     * @return TournamentPool
     */
    public function setHitVictoryPoints(int $hitVictoryPoints): TournamentPool
    {
        $this->hitVictoryPoints = $hitVictoryPoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitTiePoints(): ?int
    {
        return $this->hitTiePoints;
    }

    /**
     * @param int $hitTiePoints
     * @return TournamentPool
     */
    public function setHitTiePoints(int $hitTiePoints): TournamentPool
    {
        $this->hitTiePoints = $hitTiePoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitScorePoints(): ?int
    {
        return $this->hitScorePoints;
    }

    /**
     * @param int $hitScorePoints
     * @return TournamentPool
     */
    public function setHitScorePoints(int $hitScorePoints): TournamentPool
    {
        $this->hitScorePoints = $hitScorePoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitHomeScorePoints(): ?int
    {
        return $this->hitHomeScorePoints;
    }

    /**
     * @param int $hitHomeScorePoints
     * @return TournamentPool
     */
    public function setHitHomeScorePoints(int $hitHomeScorePoints): TournamentPool
    {
        $this->hitHomeScorePoints = $hitHomeScorePoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitVisitorScorePoints(): ?int
    {
        return $this->hitVisitorScorePoints;
    }

    /**
     * @param int $hitVisitorScorePoints
     * @return TournamentPool
     */
    public function setHitVisitorScorePoints(int $hitVisitorScorePoints): TournamentPool
    {
        $this->hitVisitorScorePoints = $hitVisitorScorePoints;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPlayers(): ?Collection
    {
        return $this->players;
    }

    /**
     * @param User $player
     * @return TournamentPool
     */
    public function addPlayer(User $player): TournamentPool
    {
        if(!$this->players->contains($player)){
            $this->players->add($player);
            if (!$player->getPlayingPools()->contains($this)) {
                $player->addPlayingPool($this);
            }
        }

        return $this;
    }

    /**
     * @param User $player
     * @return TournamentPool
     */
    public function removePlayer(User $player): TournamentPool
    {
        if($this->players->contains($player)){
            $this->players->remove($player);
            if ($player->getPlayingPools()->contains($this)) {
                $player->removePlayingPool($this);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getPoolTickets(): ?Collection
    {
        return $this->poolTickets;
    }
}
