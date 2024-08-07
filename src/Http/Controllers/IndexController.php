<?php

namespace Rickgroen\Minesweeper\Http\Controllers;

use Rickgroen\Minesweeper\Http\Responses\IndexResponse;;

class IndexController
{
    public function index(
        IndexResponse $response,
    ): IndexResponse
    {
        return $response;
    }
}