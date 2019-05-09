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
class Group
{
    use TimestampableEntity;

    /**
     * @var string
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     */
    private $groupLetter;

    /**
     * @var Tournament
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="groups")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Team")
     * @ORM\JoinTable(name="group_teams",
     *     joinColumns={@ORM\JoinColumn(name="tournament_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
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
     * @return Group
     */
    public function setName(string $name): Group
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroupLetter(): string
    {
        return $this->groupLetter;
    }

    /**
     * @param string $groupLetter
     * @return Group
     */
    public function setGroupLetter(string $groupLetter): Group
    {
        $this->groupLetter = $groupLetter;

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
     * @return Group
     */
    public function setTournament(Tournament $tournament): Group
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    /**
     * @param Team $team
     * @return Group
     */
    public function addTeam(Team $team): Group
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    /**
     * @param Team $team
     * @return Group
     */
    public function removeTeam(Team $team): Group
    {
        if (!$this->teams->contains($team)) {
            $this->teams->remove($team);
        }

        return $this;
    }
}
