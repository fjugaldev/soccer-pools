<?php

namespace InnovatikLabs\Shared\Infrastructure\UseCase;

use InnovatikLabs\Shared\Domain\Persistence\Redis\RedisRepositoryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class BaseUseCase
{
    use HandleTrait;

    const TTL_ONE_DAY = 86400;

    /**
     * @var RedisRepositoryInterface
     */
    private $redisRepository;

    /**
     * @param MessageBusInterface $messageBus
     * @param RedisRepositoryInterface $redisRepository
     */
    public function __construct(MessageBusInterface $messageBus, RedisRepositoryInterface $redisRepository)
    {
        $this->messageBus = $messageBus;
        $this->redisRepository = $redisRepository;
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

    /**
     * @param string $key
     * @param $value
     * @param int $ttl
     * @param bool $isObject
     */
    public function save(string $key, $value, int $ttl = 0, bool $isObject = false)
    {
        $isObject ? $this->redisRepository->setObject($key, $value, $ttl)
            : $this->redisRepository->set($key, $value, $ttl);
    }

    /**
     * @param string $key
     * @param bool $isObject
     *
     * @return array|string|null
     */
    public function load(string $key, bool $isObject = false)
    {
        return $isObject ? $this->redisRepository->getObject($key) : $this->redisRepository->get($key);
    }
}
