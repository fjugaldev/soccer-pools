<?php

namespace App\Domain\Player\ValueObject;

use App\Domain\User\ValueObject\User;

class Player extends User
{
    const ROLE_DEFAULT = 'ROLE_PLAYER';
}
