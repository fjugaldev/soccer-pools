<?php

namespace App\Api\Shared\Domain\Model;

use Doctrine\Common\Collections\Collection;

class TournamentPhase extends BaseEntity
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
     * @var Tournament
     */
    private $tournament;

    /**
     * @var Collection
     */
    private $matches;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TournamentPhase
     */
    public function setName(string $name): TournamentPhase
    {
        $this->name = $name;

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
     * @return TournamentPhase
     */
    public function setTournament(Tournament $tournament): TournamentPhase
    {
        $this->tournament = $tournament;

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
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}