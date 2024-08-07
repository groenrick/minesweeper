<?php

namespace Rickgroen\Minesweeper\Game;

class Board
{
    /** @var Tile[] */
    public array $tiles;

    public function __construct(
        public readonly int $rows,
        public readonly int $columns,
    )
    {
        $this->tiles = $this->createTiles();
    }

    /**
     * @return Tile[]
     */
    private function createTiles(): array
    {
        $tiles = [];

        for ($row = 0; $row < $this->rows; $row++) {
            for ($column = 0; $column < $this->columns; $column++) {
                $tiles[] = new Tile(
                    row: $row,
                    column: $column,
                );
            }
        }

        return $tiles;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    public function getTile(int $row, int $column): Tile
    {
        return $this->tiles[$row * $this->columns + $column];
    }

    public function setTile(int $row, int $column, Tile $tile): void
    {
        $this->tiles[$row * $this->columns + $column] = $tile;
    }

    /**
     * @return Tile[]
     */
    public function getAdjacentTiles(Tile $tile): array
    {
        $adjacentTiles = [];

        for ($row = $tile->row - 1; $row <= $tile->row + 1; $row++) {
            for ($column = $tile->column - 1; $column <= $tile->column + 1; $column++) {
                if ($row === $tile->row && $column === $tile->column) {
                    continue;
                }

                if ($row < 0 || $row >= $this->rows || $column < 0 || $column >= $this->columns) {
                    continue;
                }

                $adjacentTiles[] = $this->getTile($row, $column);
            }
        }

        return $adjacentTiles;
    }
}
