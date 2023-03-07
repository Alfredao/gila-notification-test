<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    return DriverManager::getConnection([
        'dbname'        => $_ENV['DOCTRINE_CONNECTION_DBNAME'],
        'user'          => $_ENV['DOCTRINE_CONNECTION_USER'],
        'password'      => $_ENV['DOCTRINE_CONNECTION_PASSWORD'],
        'host'          => $_ENV['DOCTRINE_CONNECTION_HOST'],
        'port'          => $_ENV['DOCTRINE_CONNECTION_PORT'], // not necessary here
        'driver'        => 'pdo_mysql',
        'charset'       => 'utf8',
        'mapping_types' => [
            'enum' => 'string',
        ],
    ]);
} catch (Exception $e) {
    echo $e->getMessage();

    exit;
}
