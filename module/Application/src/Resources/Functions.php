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
     * Is a windows environment?
     *
     * @return boolean
     */
    public static function isWindows()
    : bool
    {
        return stripos(PHP_OS_FAMILY, 'win') === 0;
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

    /**
     * Tail file
     *
     * @param string $filename
     * @param int $lines
     * @param int $buffer
     * @return string
     */
    public static function tail(string $filename, int $lines = 50, int $buffer = 4096)
    : string
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
}
