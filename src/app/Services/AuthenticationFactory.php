<?php

namespace App\Services;

class AuthenticationFactory
{
    public static function create($model): Authentication
    {
        return new Authentication($model);
    }
}
