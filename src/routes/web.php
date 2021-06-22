<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('user', new Route(
    'user/{id}',
    array('controller' => 'UserController', 'method' => 'show'),
    array('id' => '[0-9]+')
));
$routes->add('', new Route(
    '/',
    array('controller' => 'HomeController', 'method' => 'show')
));
