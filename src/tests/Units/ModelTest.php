<?php

namespace Tests\Units;

use App\Database\Database;
use App\Database\Import;
use App\Models\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    private $model;

    public function setUp(): void
    {
        Import::getInstance()->sql(Database::getInstance()->getConnection());
        $this->model = new Model();
        $this->model->setTable('Users');
        parent::setUp();
    }

    public function testCURD()
    {
        $result = $this->model->create(['email' => 'email@gsadas.com', 'password' => 'skahsi']);
        $this->assertEquals(2, $result);

        $row = $this->model->update(['email' => 'email@dsd.com'], $result);
        $this->assertEquals(1, $row);

        $user = $this->model->get($result);
        $this->assertEquals('email@dsd.com', $user->email);

        $result = $this->model->fetch(array('email' => $user->email));
        $this->assertEquals(2, $result->id);

        $this->assertTrue($this->model->delete($user->id));

        $user = $this->model->get($user->id);
        $this->assertNull($user);
    }
}
