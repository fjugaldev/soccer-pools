<?php

namespace InnovatikLabs\Shared\Domain\Persistence\Redis;

interface RedisRepositoryInterface
{
    /**
     * @param $key
     * @return string
     */
    public function get($key);

    /**
     * @param array $keys
     */
    public function invalidate(array $keys);

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     */
    public function set($key, $value, $ttl = 0);

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     */
    public function setObject($key, $value, $ttl = 0);

    /**
     * @param $key
     * @return array|null
     */
    public function getObject($key): ?array;
}