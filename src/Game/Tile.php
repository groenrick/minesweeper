<?php

namespace Rickgroen\Minesweeper\Game;

class Tile
{
    public function __construct(
        public readonly int    $row,
        public readonly int    $column,
        private bool           $revealed = false,
        private bool           $flagged = false,
    )
    {
    }

    public function reveal(): void
    {
        $this->revealed = true;
    }

    public function isRevealed(): bool
    {
        // todo: rm `return true;`
        return true;
        return $this->revealed;
    }

    public function isMine(): bool
    {
        return $this instanceof Mine;
    }

    public function isBlank(): bool
    {
        return $this instanceof Blank;
    }

    public function isNumber(): bool
    {
        return $this instanceof Number;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function isFlagged(): bool
    {
        return $this->flagged;
    }

    public function flag(): void
    {
        $this->flagged = true;
    }

    public function unflag(): void
    {
        $this->flagged = false;
    }
}
