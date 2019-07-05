<?php

namespace App\Domain\Group\ValueObject;

use App\Domain\Match\ValueObject\Match;
use App\Domain\Shared\ValueObject\BaseEntity;
use App\Domain\Team\ValueObject\Team;
use App\Domain\Tournament\ValueObject\Tournament;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group extends BaseEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $groupLetter;

    /**
     * @var Tournament
     */
    private $tournament;

    /**
     * @var Collection
     */
    private $teams;

    /**
     * @var Collection
     */
    private $matches;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->matches = new ArrayCollection();
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
    public function getGroupLetter(): ?string
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
    public function getTournament(): ?Tournament
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
    public function getTeams(): ?Collection
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

    /**
     * @return Collection
     */
    public function getMatches(): ?Collection
    {
        return $this->matches;
    }

    /**
     * @param Match $match
     * @return Group
     */
    public function addMatch(Match $match): Group
    {
        if(!$this->matches->contains($match)) {
            $this->matches->add($match);
            if(!$match->getGroup() === $this){
                $match->setGroup($this);
            }
        }

        return $this;
    }

    /**
     * @param Match $match
     * @return Group
     */
    public function removeMatch(Match $match): Group
    {
        if($this->matches->contains($match)) {
            $this->matches->remove($match);
            if($match->getGroup() === $this){
                $match->setGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
