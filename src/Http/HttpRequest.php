<?php

namespace Rickgroen\Minesweeper\Http;

class HttpRequest
{
    /**
     * @var array<string, string>

     */
    protected array $params;

    public function __construct(
        public string $method,
        public string $uri,
    ) {
    }
}
