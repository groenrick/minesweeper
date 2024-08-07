<?php

namespace Rickgroen\Minesweeper;

use DI\Container;
use Rickgroen\Minesweeper\Http\HttpRequest;

readonly class App
{
    public function __construct(
        private Container $container,
        private Router    $router,
    )
    {}

    public function run(): void
    {
        $this->router->dispatch(
            $this->container->get(HttpRequest::class),
        );
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
