<?php

declare(strict_types=1);

namespace Application;

use Defuse\Crypto\Key;

/**
 * Functions
 *
 * @package Application
 */
abstract class Utils
{

    /**
     * Group array
     *
     * @param array $items
     * @param \Closure $callback
     * @return array
     */
    public static function groupBy(array $items, \Closure $callback)
    : array
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
     * Is production env?
     *
     * @return bool
     */
    public static function isProduction()
    : bool
    {
        return self::getAppEnv() === 'production';
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

    /**
     * Tail file
     *
     * @param string $filename
     * @param int $lines
     * @param int $buffer
     * @return string
     */
    public static function tail(string $filename, int $lines = 50, int $buffer = 4096)
    {
        // Open the file
        $f = fopen($filename, "rb");

        // Jump to last character
        fseek($f, -1, SEEK_END);

        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) !== "\n") {
            --$lines;
        }

        // Start reading
        $output = '';
        $chunk  = '';

        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {
            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);

            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);

            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;

            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");
        }

        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);
        }

        // Close file and return
        fclose($f);

        return $output;
    }

    /**
     * Load PHP Defuse encryption key
     *
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     * @throws \Defuse\Crypto\Exception\BadFormatException
     */
    public static function loadDefuseKey()
    : Key
    {
        $path = sprintf('%s/.php-defuse-key', static::getRootDir());

        if (! file_exists($path)) {
            throw new \RuntimeException('Invalid defuse key');
        }

        $keyAscii = file_get_contents($path);

        return Key::loadFromAsciiSafeString($keyAscii);
    }
}
