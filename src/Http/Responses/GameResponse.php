<?php

namespace Rickgroen\Minesweeper\Http\Responses;

use Rickgroen\Minesweeper\Game\Game;

class GameResponse extends BaseResponse
{
    public function __construct(
        public Game $game,
    ){}

    public function getData(): array
    {
        $data = [];

        foreach ($this->game->board->getTiles() as $tile) {
            /** Tile $tile */
            $tileData = [
                'row' => $tile->row,
                'column' => $tile->column,
                'isBlank' => $tile->isBlank(),
                'isNumber' => $tile->isNumber(),
                'isRevealed' => $tile->isRevealed(),
                'isFlagged' => $tile->isFlagged(),
                'isMine' => null,
                'neighbouringMines' => null,
            ];

            if ($tile->isRevealed()) {

                $tileData['isMine'] = $tile->isMine();

                if ($tile instanceof \Rickgroen\Minesweeper\Game\Number) {
                    $tileData['neighbouringMines'] = $tile->value;
                }
            }

            $data[] = $tileData;
        }

        return $data;
    }
}