<?php

namespace Andreger\ChessPosition\Services;

use Andreger\ChessPosition\Models\Piece\Bishop;
use Andreger\ChessPosition\Models\Piece\King;
use Andreger\ChessPosition\Models\Piece\Knight;
use Andreger\ChessPosition\Models\Piece\Pawn;
use Andreger\ChessPosition\Models\Piece\Piece;
use Andreger\ChessPosition\Models\Piece\Queen;
use Andreger\ChessPosition\Models\Piece\Rook;
use Andreger\ChessPosition\Models\Square;

class PieceService
{
    public function create(string $code, Square $square)
    {
        $piece = new Piece($code, $square);

        switch ($piece->type) {
            case Piece::KING: $class = King::class; break;
            case Piece::QUEEN: $class = Queen::class; break;
            case Piece::ROOK: $class = Rook::class; break;
            case Piece::BISHOP: $class = Bishop::class; break;
            case Piece::KNIGHT: $class = Knight::class; break;
            case Piece::PAWN: $class = Pawn::class; break;
            default: $class = null;
        }

        if ($class) {
            $piece = new \ReflectionClass($class);
            return $piece->newInstanceArgs([
                'code' => $code,
                'square' => $square
            ]);
        }

        return null;
    }
}
