<?php

namespace App\Shared\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
