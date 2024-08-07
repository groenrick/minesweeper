<?php

use Rickgroen\Minesweeper\Http\Controllers\GameController;
use Rickgroen\Minesweeper\Http\Controllers\IndexController;

return [
    'GET' => [
        '/api/game' => [GameController::class, 'index'],
        '/' => [IndexController::class, 'index']
    ],
    'POST' => [],
];