<?php

declare(strict_types=1);

namespace Application\Resources;

/**
 * Functions
 *
 * @package Application
 */
abstract class Functions
{

    /**
     * Group array
     *
     * @param array $items
     * @param \Closure $callback
     * @return mixed
     */
    public static function groupBy(array $items, \Closure $callback)
    : mixed
    {
        return array_reduce($items, static function ($group, $item) use ($callback) {
            $group[$callback($item)][] = $item;

            return $group;
        }, []);
    }

    /**
     * Swap array
     *
     * @param $array
     * @param $swap_a
     * @param $swap_b
     */
    public static function swapArray(&$array, $swap_a, $swap_b)
    : void
    {
        [$array[$swap_a], $array[$swap_b]] = [$array[$swap_b], $array[$swap_a]];
    }

    /**
     * Is production?
     *
     * @return boolean
     */
    public static function isProduction()
    : bool
    {
        return self::getAppEnv() === 'production';
    }

    /**
     * Get app env
     *
     * @return string
     */
    public static function getAppEnv()
    : string
    {
        return strtolower(static::getEnv('APP_ENV'));
    }

    /**
     * Get env
     *
     * @param $name
     * @return string
     */
    public static function getEnv($name)
    : string
    {
        return strtolower($_ENV[$name]);
    }

    /**
     * Get domain
     *
     * @return string|null
     */
    public static function getDomain()
    : ?string
    {
        return $_SERVER['HTTP_HOST'] ?? null;
    }


    /**
     * Get root dir
     *
     * @return false|string
     */
    public static function getRootDir()
    : bool|string
    {
        return getcwd();
    }
}
