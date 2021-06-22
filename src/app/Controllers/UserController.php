<?php

namespace App\Controllers;

use App\Models\UserInterface;
use App\Request\RequestInterface;

class UserController
{
    public UserInterface $model;

    public function __construct(UserInterface $model)
    {
        $this->model = $model;
    }

    public function show($id, RequestInterface $request)
    {
        $user = $this->model->findById($id);
        echo $user ? $user->email : 'No User';
        exit;
    }

    public function login(RequestInterface $request)
    {
    }
}
