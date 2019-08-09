<?php

namespace InnovatikLabs\UI\Http\Rest\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use InnovatikLabs\Shared\Domain\Persistence\Redis\RedisRepositoryInterface;

abstract class AbstractBaseController extends AbstractFOSRestController
{
    /**
     * @var RedisRepositoryInterface
     */
    private $redisRepository;

    public function __construct(RedisRepositoryInterface $redisRepository)
    {
        $this->redisRepository = $redisRepository;
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
     * @return object|string|null
     */
    public function load(string $key, bool $isObject = false)
    {
        return $isObject ? $this->redisRepository->getObject($key) : $this->redisRepository->get($key);
    }
}
