<?php

namespace App\Models;

/**
 * Interface UserInterface
 * @package App\Models
 */
interface UserInterface
{
    /**
     * @param string $email
     * @return object|null
     */
    public function findByEmail(string $email): ?object;

    /**
     * @param int $id
     * @return object|null
     */
    public function findById(int $id): ?object;

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool;
}
