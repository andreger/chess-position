<?php

namespace Andreger\ChessPosition;

class Position
{
    private $fen;

    private $piecePlacement;

    private $activeColor;

    private $castling;

    private $enPassant;

    private $halfmoveClock;

    private $fullmoveClock;

    private $squares;

    public function __construct(?string $fen = null)
    {
        if ($fen) {
            $this->loadFen($fen);
        }
    }

    public function loadFen(string $fen)
    {
        $this->fen = $fen;
        $this->explodeFen($fen);
        $this->initSquares();
    }

    private function explodeFen(string $fen)
    {
        $fen = explode(" ", $fen);

        $this->piecePlacement = $fen[0];

        if (isset($fen[1]))
            $this->activeColor = $fen[1];

        if (isset($fen[2]))
            $this->castling = $fen[2];

        if (isset($fen[3]))
            $this->enPassant = $fen[3];

        if (isset($fen[4]))
            $this->halfmoveClock = $fen[4];

        if (isset($fen[5]))
            $this->fullmoveClock = $fen[5];
    }

    private function initSquares()
    {
        $piecePlacement = $this->piecePlacement;

        for ($i = 1; $i <= 8; $i++) {
            $piecePlacement = str_replace($i, str_repeat(' ', $i), $piecePlacement);
        }

        $rows = explode('/', $piecePlacement);
        for ($i = 7; $i >= 0; $i--) {
            $cols = str_split($rows[$i]);

            for ($j = 0; $j <= 7; $j++) {
                $this->squares[7-$i][$j] = $cols[$j] != ' ' ? new Piece($cols[$j]) : null;
            }
        }
    }
    
}
