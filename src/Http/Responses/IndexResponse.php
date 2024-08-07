<?php

namespace Rickgroen\Minesweeper\Http\Responses;

use Jenssegers\Blade\Blade;

class IndexResponse extends BaseResponse
{
    public bool $isJson = false;

    public function __construct(
        private Blade $blade,
    ) {}

    public function getContent(): string
    {
        return $this->blade->make('index')->render();
    }
}