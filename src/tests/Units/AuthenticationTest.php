<?php

namespace Tests\Units;

use App\Database\Database;
use App\Database\Import;
use App\Models\Model;
use App\Models\User;
use App\Services\AuthenticationFactory;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    private $model;

    public function setUp(): void
    {
        Import::getInstance()->sql(Database::getInstance()->getConnection());
        $this->model = new User();
        parent::setUp();
    }

    public function testAuthLogin()
    {
        $this->model->create(['email' => 'email@gsadas.com', 'password' => $this->model->getHashedPassword('skahsi')]);

        $auth = AuthenticationFactory::create($this->model);

        $result = $auth->login('email@gsadas.com', 'skahsi');

        $this->assertTrue($result);
        $this->assertEquals(2, $_SESSION['id']);
    }

    public function testAuthLogout()
    {
        $this->model->create(['email' => 'email@gsadas.com', 'password' => $this->model->getHashedPassword('skahsi')]);

        $auth = AuthenticationFactory::create($this->model);

        $auth->login('email@gsadas.com', 'skahsi');

        $auth->logout();
    }
}
