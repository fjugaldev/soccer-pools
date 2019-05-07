<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Team extends BaseEntity
{
    use TimestampableEntity;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=3)
     */
    private $fifaCode;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     */
    private $iso2;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $flag;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getFifaCode(): string
    {
        return $this->fifaCode;
    }

    /**
     * @param string $fifaCode
     * @return Team
     */
    public function setFifaCode(string $fifaCode): Team
    {
        $this->fifaCode = $fifaCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso2(): string
    {
        return $this->iso2;
    }

    /**
     * @param string $iso2
     * @return Team
     */
    public function setIso2(string $iso2): Team
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * @return string
     */
    public function getFlag(): string
    {
        return $this->flag;
    }

    /**
     * @param string $flag
     * @return Team
     */
    public function setFlag(string $flag): Team
    {
        $this->flag = $flag;

        return $this;
    }
}
