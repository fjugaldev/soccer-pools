<?php

namespace App\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    const ROLE_DEFAULT = 'ROLE_PLAYER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="TournamentPool", mappedBy="owner")
     */
    private $owningPools;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="TournamentPool", mappedBy="players")
     */
    private $playingPools;

    public function __construct()
    {
        parent::__construct();
        $this->owningPools = new ArrayCollection();
        $this->playingPools= new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getOwningPools(): Collection
    {
        return $this->owningPools;
    }

    /**
     * @return Collection
     */
    public function getPlayingPools(): Collection
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
