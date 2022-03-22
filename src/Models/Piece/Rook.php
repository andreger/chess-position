<?php

namespace Andreger\ChessPosition\Models\Piece;

class Rook extends Piece implements MoveInterface
{

    public function moves(): array
    {
        $moves = [];
        $candidates = [];

        for ($col = 0; $col < 8; $col++) {
            $candidates[] = (object)[
                'row' => $this->square->row,
                'col' => $col,
            ];
        }

        for ($row = 0; $row < 8; $row++) {
            $candidates[] = (object)[
                'row' => $row,
                'col' => $this->square->col,
            ];
        }

        foreach ($candidates as $candidate) {
            if (! $this->isOnCoordinate($candidate->row, $candidate->col)) {
                $moves[] = $this->squareService->coordinateToAlgebric($candidate->row, $candidate->col);
            }
        }

        return $moves;
    }

    public function allowedMoves(): array
    {
        // TODO: Implement allowedMoves() method.
    }

    public function deniedMoves(): array
    {
        // TODO: Implement deniedMoves() method.
    }
}
