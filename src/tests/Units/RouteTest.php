<?php

namespace Tests\Units;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Request\Request;
use App\Routes\Routes;

class RouteTest extends TestCase
{
    public function testGetRouteWhenNotExist()
    {
        $routes = new RouteCollection();
        $routes->add('', new Route(
            '/',
            array('controller' => 'HomeController', 'method' => 'test')
        ));

        $route = new Routes(new Request('/test', 'GET'));

        $route->resolve($routes);

        $this->expectOutputString('Route does not exists.');
    }
}
