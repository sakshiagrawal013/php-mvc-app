<?php

namespace App\Routes;

use App\Request\RequestInterface;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NoConfigurationException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use League\Container\Container;

/**
 * Class Routes
 * @package App\Routes
 */
class Routes
{
    private RequestInterface $request;
    private Container $container;

    /**
     * Routes constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request, $container)
    {
        $this->request = $request;
        $this->container = $container;
    }

    /**
     * @param RouteCollection $routes
     */
    public function resolve(RouteCollection $routes)
    {
        $context = new RequestContext();

        // Routing can match routes with incoming requests
        $matcher = new UrlMatcher($routes, $context);
        try {
            $matcher = $matcher->match($this->request->getUri());

            array_walk($matcher, function (&$param) {
                if (is_numeric($param)) {
                    $param = (int)$param;
                }
            });
            $requests = (array) array_slice($matcher, 2, -1);

            if ($this->request->isGetMethod() && !empty($requests)) {
                array_push($requests, $this->request);
                $this->callRoute($matcher, $requests);
                return;
            }

            $this->callRoute($matcher, array($this->request));
        } catch (MethodNotAllowedException $e) {
            echo 'Route method is not allowed.';
        } catch (ResourceNotFoundException $e) {
            echo 'Route does not exists.';
        } catch (NoConfigurationException $e) {
            echo 'Configuration does not exists.';
        }
    }

    /**
     * @param array $matcher
     * @param array $requests
     */
    private function callRoute(array $matcher, array $requests): void
    {
        $className = 'App\Controllers\\' . $matcher['controller'];

        $controller = $this->container->get($className);

        //$controller = new $className();
        call_user_func_array(array($controller, $matcher['method']), $requests);
    }
}
