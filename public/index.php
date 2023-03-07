<?php
declare(strict_types=1);

use Laminas\ApiTools\Application;
use Laminas\Stdlib\ArrayUtils;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Redirect legacy requests to enable/disable development mode to new tool
if (PHP_SAPI === 'cli'
    && $argc > 2
    && 'development' === $argv[1]
    && in_array($argv[2], ['disable', 'enable'])
) {
    // Windows needs to execute the batch scripts that Composer generates,
    // and not the Unix shell version.
    $script = defined('PHP_WINDOWS_VERSION_BUILD') && constant('PHP_WINDOWS_VERSION_BUILD')
        ? '.\\vendor\\bin\\laminas-development-mode.bat'
        : './vendor/bin/laminas-development-mode';
    system(sprintf('%s %s', $script, $argv[2]), $return);
    exit($return);
}

// Decline static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

if (!file_exists('vendor/autoload.php')) {
    throw new RuntimeException(
        'Unable to load application.' . PHP_EOL
        . '- Type `docker-compose run cryptopay-php-apache composer install` to install.'
    );
}

// Setup autoloading
include 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..');
$dotenv->load();

$appConfig = include 'config/application.config.php';

if (file_exists('config/development.config.php')) {
    $appConfig = ArrayUtils::merge(
        $appConfig,
        include 'config/development.config.php'
    );
}

// Run the application!
Application::init($appConfig)->run();
