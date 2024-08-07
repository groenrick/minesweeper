<?php

namespace Rickgroen\Minesweeper;

use DI\Container;
use Rickgroen\Minesweeper\Http\HttpRequest;

class Router
{
    /**
     * @var array<string, array<string, array<string>>>
     */
    public array $routes;

    public function __construct(
        private readonly Container $container,
    )
    {
        $this->routes = require __DIR__ . '/../config/routes.php';
    }

    public function dispatch(
        HttpRequest $httpRequest,
    ): void
    {
        if (!array_key_exists($httpRequest->method, $this->routes)) {
            // todo: throw exception
            echo 'Method not allowed';
            return;
        }

        if (!array_key_exists($httpRequest->uri, $this->routes[$httpRequest->method])) {
            // todo: throw exception
            echo 'Route not found';
            return;
        }

        $action = $this->routes[$httpRequest->method][$httpRequest->uri];
        $controller = $action[0];
        $method = $action[1];

//        dd($controller, $method);
        $response = $this->container->call($controller.'::'.$method);
        $response->send();
    }
}