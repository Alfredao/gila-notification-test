<?php

declare(strict_types=1);

namespace Application\Resources;

use Application\Cache\Redis;

/**
 * Interface EntityManagerAwareInterface
 *
 * @package Application\Resources
 */
interface RedisAwareInterface
{

    /**
     * Get entity manager
     *
     * @return \Application\Cache\Redis
     */
    public function getRedis()
    : Redis;

    /**
     * Set entity manager
     *
     * @param \Application\Cache\Redis $redis
     * @return $this
     */
    public function setRedis(Redis $redis)
    : static;
}
