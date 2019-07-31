<?php

namespace InnovatikLabs\Game\TournamentPhase\Domain\Model;

use InnovatikLabs\Shared\Domain\Model\BaseEntity;
use InnovatikLabs\Game\Tournament\Domain\Model\Tournament;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class TournamentPhase extends BaseEntity
{
    /**
     * @var UuidInterface
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
