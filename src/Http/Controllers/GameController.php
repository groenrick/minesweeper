<?php

namespace Rickgroen\Minesweeper\Http\Controllers;

use Rickgroen\Minesweeper\Game\Game;
use Rickgroen\Minesweeper\Http\Responses\GameResponse;

class GameController
{
    public function index(
        GameResponse $response,
    ): GameResponse
    {
        return $response;
    }
}