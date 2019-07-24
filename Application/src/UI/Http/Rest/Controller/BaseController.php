<?php

namespace App\UI\Http\Rest\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class BaseController extends AbstractFOSRestController
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

