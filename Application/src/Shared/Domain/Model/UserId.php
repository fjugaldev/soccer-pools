<?php

namespace InnovatikLabs\Shared\Domain\Model;

use Assert\Assertion;
use Assert\AssertionFailedException;

class UserId
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $userId

     * @return UserId
     */
    public static function fromInteger(int $userId): UserId
    {
        Assertion::integer($userId);
        $userIdClass = new self();
        $userIdClass->id = $userId;

        return $userIdClass;
    }

    public function toString(): string
    {
        return (string) $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}
