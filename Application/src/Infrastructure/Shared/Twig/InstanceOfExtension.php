<?php

namespace App\Infrastructure\Shared\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class InstanceOfExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('instanceOf', [$this, 'instanceOf']),
        ];
    }

    public function instanceOf($object, $className): bool
    {
        $reflectionClass = new \ReflectionClass($className);

        return $reflectionClass->isInstance($object);
    }
}
