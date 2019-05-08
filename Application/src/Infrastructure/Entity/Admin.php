<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Admin extends User
{
    use TimestampableEntity;

    const ROLE_DEFAULT = 'ROLE_ADMIN';
}