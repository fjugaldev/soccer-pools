<?php

namespace InnovatikLabs\Shared\Infrastructure\Persistence\Redis;

use InnovatikLabs\Shared\Domain\Persistence\Redis\RedisRepositoryInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Predis\ClientInterface;

class RedisRepository implements RedisRepositoryInterface
{
    /**
     * @var ClientInterface
     */
    private $redisClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param ClientInterface $redisClient
     * @param SerializerInterface $serializer
     */
    public function __construct(ClientInterface $redisClient, SerializerInterface $serializer)
    {
        $this->redisClient = $redisClient;
        $this->serializer = $serializer;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key)
    {
        return $this->redisClient->get($key);
    }

    /**
     * @param array $keys
     */
    public function invalidate(array $keys)
    {
        $this->redisClient->del($keys);
    }

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     */
    public function set($key, $value, $ttl = 0)
    {
        if($ttl >0) {
            $this->redisClient->setex($key, $ttl, $value);
        }else{
            $this->redisClient->set($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     */
    public function setObject($key, $value, $ttl = 0)
    {
        //$json = $this->serializer->serialize($value, 'json', SerializationContext::create());
        $json = json_encode($value);
        $this->set($key, $json, $ttl);
    }

    /**
     * @param $key
     * @return array|null
     */
    public function getObject($key): ?array
    {
        $data = $this->redisClient->get($key);
        if(!$data){
            return null;
        }

        //return $this->serializer->deserialize($object, 'array','json');
        return json_decode($data, true);
    }
}