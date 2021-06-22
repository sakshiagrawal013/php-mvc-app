<?php
require '../bootstrap.php';
require_once '../routes/web.php';

use App\Request\Request;
use App\Routes\Routes;

$route = new Routes(new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']), $container);

$route->resolve($routes);
