<?php

namespace App\Services;

use App\Models\UserInterface;

/**
 * Class Authentication
 * @package App\Services
 */
class Authentication
{
    private UserInterface $model;

    /**
     * Authentication constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->model = $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        $user = $this->model->findByEmail($email);

        if ($user->id && $user->verifyPassword($password)) {
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $user->email;
            $_SESSION['id'] = $user->id;
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        session_destroy();
        return true;
    }
}
