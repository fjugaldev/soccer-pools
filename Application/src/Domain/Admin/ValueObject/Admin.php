<?php

namespace App\Domain\Admin\ValueObject;

use App\Domain\User\ValueObject\User;

class Admin extends User
{
    const ROLE_DEFAULT = 'ROLE_ADMIN';
}
