<?php

namespace App\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Tournament extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var string
     * @ORM\Column(type="string", length=120)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $fromDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $toDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Team")
     * @ORM\JoinTable(name="tournament_teams",
     *     joinColumns={@ORM\JoinColumn(name="tournament_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="team_id", referencedColumnName="id")}
     * )
     */
    private $teams;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Group", mappedBy="tournament")
     */
    private $groups;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Match", mappedBy="tournament")
     */
    private $matches;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="TournamentPool", mappedBy="tournament")
     */
    private $pools;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->matches = new ArrayCollection();
        $this->pools = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Tournament
     */
    public function setName(string $name): Tournament
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Tournament
     */
    public function setDescription(string $description): Tournament
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFromDate(): \DateTime
    {
        return $this->fromDate;
    }

    /**
     * @param \DateTime $fromDate
     * @return Tournament
     */
    public function setFromDate(\DateTime $fromDate): Tournament
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getToDate(): \DateTime
    {
        return $this->toDate;
    }

    /**
     * @param \DateTime $toDate
     * @return Tournament
     */
    public function setToDate(\DateTime $toDate): Tournament
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Tournament
     */
    public function setLogo(string $logo): Tournament
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTeams(): Collection
    {
        return $this->groups;
    }

    /**
     * @param Team $team
     * @return Tournament
     */
    public function addTeam(Team $team): Tournament
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    /**
     * @param Team $team
     * @return Tournament
     */
    public function removeTeam(Team $team): Tournament
    {
        if (!$this->teams->contains($team)) {
            $this->teams->remove($team);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     * @return Tournament
     */
    public function addGroup(Group $group): Tournament
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
            $group->setTournament($this);
        }

        return $this;
    }

    /**
     * @param Group $group
     * @return Tournament
     */
    public function removeGroup(Group $group): Tournament
    {
        if (!$this->groups->contains($group)) {
            $this->groups->remove($group);
            if ($group->getTournament() === $this) {
                $group->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    /**
     * @param Match $match
     * @return Tournament
     */
    public function addMatch(Match $match): Tournament
    {
        if (!$this->matches->contains($match)) {
            $this->matches->add($match);
            $match->setTournament($this);
        }

        return $this;
    }

    /**
     * @param Match $match
     * @return Tournament
     */
    public function removeMatch(Match $match): Tournament
    {
        if (!$this->matches->contains($match)) {
            $this->matches->remove($match);
            if ($match->getTournament() === $this) {
                $match->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPools(): Collection
    {
        return $this->pools;
    }

    /**
     * @param TournamentPool $pool
     * @return Tournament
     */
    public function addPool(TournamentPool $pool): Tournament
    {
        if (!$this->pools->contains($pool)) {
            $this->pools->add($pool);
            $pool->setTournament($this);
        }

        return $this;
    }

    /**
     * @param TournamentPool $pool
     * @return Tournament
     */
    public function removePool(TournamentPool $pool): Tournament
    {
        if (!$this->pools->contains($pool)) {
            $this->pools->remove($pool);
            if ($pool->getTournament() === $this) {
                $pool->setTournament(null);
            }
        }

        return $this;
    }
}
