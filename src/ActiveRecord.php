<?php
namespace Dudoserovich\ToDoPhp;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

class ActiveRecord
{
    protected static $connection;

    protected static function connect() {
        if (!isset(self::$connection)) {
            self::$connection = new \PDO('mysql:host=' . $_ENV['HOST']
                . ';dbname=' . $_ENV['DB_NAME'] . ';port='
                . $_ENV['PORT'],
                $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        }
    }

    protected static function unsetConnect() {
        self::$connection = null;
    }
}