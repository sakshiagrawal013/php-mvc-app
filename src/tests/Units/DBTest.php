<?php

use PHPUnit\Framework\TestCase;

use App\Database\Database;

class DBTest extends TestCase
{
    public function testTrue()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $this->assertInstanceOf('mysqli', $conn);
    }
}
