<?php

namespace Rickgroen\Minesweeper\Game;

use Random\RandomException;

class MinePopulatorService
{
    /**
     * @throws RandomException
     */
    public static function populateMinesOnBoard(Board $board, int $mines): void
    {
        $tiles = $board->getTiles();
        $tilesCount = count($tiles);
        $minesCount = 0;

        while ($minesCount < $mines) {
            $randomIndex = random_int(0, $tilesCount - 1);
            $tile = $tiles[$randomIndex];

            if ($tile instanceof Mine) {
                continue;
            }

            $mineTile = new Mine(
                row: $tile->getRow(),
                column: $tile->getColumn(),
            );

            $board->setTile(
                $tile->getRow(),
                $tile->getColumn(),
                $mineTile,
            );

            $minesCount++;
        }
    }
}