<?php

namespace App\Database;

use mysqli;

/**
 * Class Import for Testing Purpose
 * @package App\Database
 */
class Import
{
    public const FILE_NAME = 'db.sql';

    private static $instace;

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
     * @param mysqli $db
     */
    public function sql(mysqli $db): void
    {
        $sql = file_get_contents(dirname(dirname(__DIR__)) . '/' . self::FILE_NAME);
        mysqli_multi_query($db, $sql);
        while (mysqli_next_result($db)) {
        }
    }
}
