<?php

namespace App\Models;

/**
 * Class User
 * @package App\Models
 */
class User extends Model implements UserInterface
{
    public int $id;
    public string $email;
    protected string $table = 'Users';

    /**
     * @param string $email
     * @return $this
     */
    public function findByEmail(string $email): ?self
    {
        $user = $this->fetch(array('email' => $email));
        return $this->setAttribute(self::class, $user);
    }

    public function findById(int $id): ?self
    {
        $user = $this->get($id);
        return $this->setAttribute(self::class, $user);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->get($this->id)->password);
    }

    /**
     * @param string $password
     * @return string
     */
    public function getHashedPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
