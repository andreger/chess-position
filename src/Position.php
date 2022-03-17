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

    /**
     * Position constructor.
     *
     * @param string|null $fen
     */
    public function __construct(?string $fen = null)
    {
        if ($fen) {
            $this->loadFen($fen);
        }

        return $this;
    }

    /**
     * Load a string on FEN notation
     *
     * @param string $fen
     * @return $this
     */
    public function loadFen(string $fen)
    {
        $this->fen = $fen;
        $this->explodeFen($fen);
        $this->initSquares();

        return $this;
    }

    /**
     * Get the piece on a square
     *
     * @param string $square Square on algebric notation
     * @return Piece|null
     */
    public function square(string $square): ?Piece
    {
        $square = str_split($square);

        switch ($square[0]) {
            case 'a': $i = 0; break;
            case 'b': $i = 1; break;
            case 'c': $i = 2; break;
            case 'd': $i = 3; break;
            case 'e': $i = 4; break;
            case 'f': $i = 5; break;
            case 'g': $i = 6; break;
            case 'h': $i = 7; break;
        }

        return $this->squares[$i][$square[1] - 1];
    }

    /**
     * Sum material relative value of a color
     *
     * @param string $color
     * @return int
     */
    public function materialValue(string $color)
    {
        $sum = 0;

        foreach ($this->squares as $cols) {
            foreach ($cols as $square) {
                $sum += $square && $square->isColor($color) ? $square->value : 0;
            }
        }

        return $sum;
    }

    /**
     * Get material difference value
     *
     * @return int
     */
    public function materialDiffValue(): int
    {
        return $this->materialValue('white') - $this->materialValue('black');
    }

    /**
     * Explode Fen string and set class parameters
     *
     * @param string $fen
     */
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

    /**
     * Init squares array
     */
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
