<?php

namespace AppRoot\Shared\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\MAppRooting as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "player" = "Player", "admin" = "Admin"})
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $lastName;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="TournamentPool", mAppRootedBy="owner")
     */
    protected $owningPools;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="TournamentPool", mAppRootedBy="players")
     */
    protected $playingPools;

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
}
