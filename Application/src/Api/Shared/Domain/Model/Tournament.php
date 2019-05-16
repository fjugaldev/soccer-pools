<?php

namespace App\Api\Shared\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Tournament extends BaseEntity
{
    const SERVER_PATH_TO_IMAGE_FOLDER = './uploads/logos/tournaments';

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
    private $description;

    /**
     * @var \DateTime
     */
    private $fromDate;

    /**
     * @var \DateTime
     */
    private $toDate;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var Federation
     */
    private $federation;

    /**
     * @var Collection
     */
    private $teams;

    /**
     * @var Collection
     */
    private $groups;

    /**
     * @var Collection
     */
    private $matches;

    /**
     * @var Collection
     */
    private $pools;

    /**
     * @var Collection
     */
    private $phases;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->matches = new ArrayCollection();
        $this->pools = new ArrayCollection();
        $this->phases = new ArrayCollection();
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload(): void
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->logo = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server.
     */
    public function lifecycleFileUpload(): void
    {
        $this->upload();
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire.
     */
    public function refreshUpdated(): void
    {
        $this->setUpdatedAt(new \DateTime());
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
    public function getDescription(): ?string
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
    public function getFromDate(): ?\DateTime
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
    public function getToDate(): ?\DateTime
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
    public function getLogo(): ?string
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
     * @return Federation
     */
    public function getFederation(): ?Federation
    {
        return $this->federation;
    }

    /**
     * @param Federation $federation
     * @return Tournament
     */
    public function setFederation(Federation $federation): Tournament
    {
        $this->federation = $federation;

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
    public function getGroups(): ?Collection
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
    public function getMatches(): ?Collection
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
    public function getPools(): ?Collection
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

    /**
     * @return Collection
     */
    public function getPhases(): ?Collection
    {
        return $this->phases;
    }

    /**
     * @param TournamentPhase $tournamentPhase
     * @return Tournament
     */
    public function addPhase(TournamentPhase $tournamentPhase): Tournament
    {
        if(!$this->phases->contains($tournamentPhase)) {
            $this->phases->add($tournamentPhase);

            if(!$tournamentPhase->getTournament() === $this) {
                $tournamentPhase->setTournament($this);
            }
        }

        return $this;
    }

    /**
     * @param TournamentPhase $tournamentPhase
     * @return Tournament
     */
    public function removePhase(TournamentPhase $tournamentPhase): Tournament
    {
        if($this->phases->contains($tournamentPhase)) {
            $this->phases->remove($tournamentPhase);

            if($tournamentPhase->getTournament() === $this) {
                $tournamentPhase->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getWebPath(): string
    {
        return self::SERVER_PATH_TO_IMAGE_FOLDER.'/'.$this->getLogo();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
