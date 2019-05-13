<?php

namespace AppRoot\Shared\Infrastructure\Entity;

use Doctrine\ORM\MAppRooting as ORM;
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