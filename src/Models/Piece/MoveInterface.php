<?php

namespace Andreger\ChessPosition\Models\Piece;

interface MoveInterface
{
    public function moves(): array;

    public function allowedMoves(): array;

    public function deniedMoves(): array;
}
