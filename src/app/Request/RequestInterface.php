<?php

namespace App\Request;

interface RequestInterface
{
    public function getBody();
    public function getMethod(): string;
    public function getUri(): string;
}
