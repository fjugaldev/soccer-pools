<?php

namespace InnovatikLabs\Shared\Infrastructure\UseCase;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class BaseUseCase
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object
     *
     * @return mixed
     */
    protected function handleMessage(object $message)
    {
        return $this->handle($message);
    }

}