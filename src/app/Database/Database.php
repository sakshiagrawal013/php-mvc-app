<?php

namespace App\Database;

use mysqli;

/**
 * Class Database
 * @package App\Database
 */
class Database
{
    /**
     * @var
     */
    private static $instace;
    private mysqli $connection;
    private $host = MYSQLI_DB_HOST;
    private $username = MYSQLI_DB_USER;
    private $password = MYSQLI_DB_PASSWORD;
    private $database = MYSQLI_DB_NAME;

    /**
     * Database constructor.
     */
    private function __construct()
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if (mysqli_connect_errno()) {
            trigger_error("Failed to Connect " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!self::$instace) {
            self::$instace = new self();
        }

        return self::$instace;
    }

    /**
     * @return mysqli
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    private function __clone()
    {
    }
}
