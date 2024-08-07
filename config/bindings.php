<?php

use Jenssegers\Blade\Blade;
use Rickgroen\Minesweeper\Game\{
    Game,
    Board,
};
use Rickgroen\Minesweeper\Http\HttpRequest;

return [
    Game::class => static fn() => new Game(
        new Board(18, 18),
        24
    ),
    HttpRequest::class => static fn() => new HttpRequest(
        $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI'],
    ),
    Blade::class => static fn() => new Blade(
        __DIR__ . '/../resources/views',
        __DIR__ . '/../cache/views',
    ),
];
