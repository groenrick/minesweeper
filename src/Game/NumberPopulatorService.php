<?php

namespace Rickgroen\Minesweeper\Game;

class NumberPopulatorService
{
    public static function populateNumbersOnBoard(Board $board): void
    {
        foreach ($board->tiles as $tile) {
            if ($tile instanceof Mine) {
                continue;
            }

            $numberTile = new Number(
                row: $tile->getRow(),
                column: $tile->getColumn(),
            );
            $numberTile->value = self::countAdjacentMines($board, $tile);

            $board->setTile(
                $tile->getRow(),
                $tile->getColumn(),
                $numberTile,
            );

        }
    }

    private static function countAdjacentMines(Board $board, Tile $tile): int
    {
        $adjacentMines = 0;

        foreach ($board->getAdjacentTiles($tile) as $adjacentTile) {
            if ($adjacentTile instanceof Mine) {
                $adjacentMines++;
            }
        }

        return $adjacentMines;
    }

}