<?php

namespace Rickgroen\Minesweeper\Game;

class Game
{
    public function __construct(
        public readonly Board $board,
        public readonly int $mines,
    )
    {
        MinePopulatorService::populateMinesOnBoard($this->board, $this->mines);
        NumberPopulatorService::populateNumbersOnBoard($this->board);
    }
}