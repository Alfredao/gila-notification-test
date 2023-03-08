<?php

declare(strict_types=1);

namespace Application\Resources;

use Application\Cache\Redis;

/**
 * Abstract data provider
 */
trait RedisAwareTrait
{
    private Redis $redis;

    /**
     * Get redis
     *
     * @return \Application\Cache\Redis
     */
    public function getRedis()
    : Redis
    {
        return $this->redis;
    }

    /**
     * Set redis
     *
     * @param \Application\Cache\Redis $redis
     * @return \Application\Resources\RedisAwareTrait
     */
    public function setRedis(Redis $redis)
    : static
    {
        $this->redis = $redis;

        return $this;
    }
}