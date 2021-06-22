<?php

namespace Tests\Units;

use App\Database\Database;
use App\Database\Import;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function setUp(): void
    {
        Import::getInstance()->sql(Database::getInstance()->getConnection());
        parent::setUp();
    }

    public function testTrue()
    {
        $this->assertTrue(true);
    }
}
