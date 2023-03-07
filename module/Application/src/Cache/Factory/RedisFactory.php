<?php
declare(strict_types=1);

namespace Application\Cache\Factory;

use Application\Cache\Redis;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Application\Cache\Redis
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \RedisException
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : Redis
    {
        $config = $container->get('Config');
        $config = $config['redis'];

        $redis = new Redis();
        $redis->connect($config['host'], $config['port'], $config['timeout']);

        if (isset($config['password']) && !empty($config['password'])) {
            $redis->auth($config['password']);
        }

        // This is not required, although it will allow to store anything that can be serialized by PHP in Redis
        $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);

        return $redis;
    }
}
