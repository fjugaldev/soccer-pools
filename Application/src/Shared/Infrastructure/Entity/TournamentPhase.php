<?php

namespace App\Shared\Infrastructure\Entity;

use Doctrine\Common\Collections\Collection;
Use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class TournamentPhase extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var Tournament
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="phases")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Match", mappedBy="phase")
     */
    private $matches;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
    public function getMatches(): Collection
    {
        return $this->matches;
    }
}