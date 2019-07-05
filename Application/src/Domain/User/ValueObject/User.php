<?php

namespace App\Domain\User\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as FOSBaseUser;

class User extends FOSBaseUser
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var Collection
     */
    protected $owningPools;

    /**
     * @var Collection
     */
    protected $playingPools;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    public function __construct()
    {
        parent::__construct();
        $this->owningPools = new ArrayCollection();
        $this->playingPools= new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOwningPools(): ?Collection
    {
        return $this->owningPools;
    }

    /**
     * @return Collection
     */
    public function getPlayingPools(): ?Collection
    {
        return $this->playingPools;
    }

    /**
     * @param TournamentPool $pool
     * @return User
     */
    public function addPlayingPool(TournamentPool $pool): User
    {
        if(!$this->playingPools->contains($pool)){
            $this->playingPools->add($pool);
            if (!$pool->getPlayers()->contains($this)) {
                $pool->addPlayer($this);
            }
        }

        return $this;
    }

    /**
     * @param TournamentPool $pool
     * @return User
     */
    public function removePlayingPool(TournamentPool $pool): User
    {
        if(!$this->playingPools->contains($pool)){
            $this->playingPools->remove($pool);
            if ($pool->getPlayers()->contains($this)) {
                $pool->removePlayer($this);
            }
        }
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function updateTimestamps(): void
    {
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime();
        }

        $this->updatedAt = new \DateTime();
    }
}
