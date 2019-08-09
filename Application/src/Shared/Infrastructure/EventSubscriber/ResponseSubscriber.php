<?php

namespace InnovatikLabs\Shared\Infrastructure\EventSubscriber;

use InnovatikLabs\Shared\Infrastructure\Helper\JsonResponseHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                ['onResponse', 10],
            ],
        ];
    }

    public function onResponse(ResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $content = json_decode($response->getContent(), true);
        if (strpos($request->getUri(), '/api/v1') !== false) {
            if ($request->getMethod() === 'GET' && $response->getStatusCode() === 200) {
                $response->setContent(json_encode(JsonResponseHelper::generateResponseBody(
                    $content['type'],
                    $request,
                    $content['data']['items'],
                    $content['data']['itemsCount']
                )));
            }
        }
    }
}