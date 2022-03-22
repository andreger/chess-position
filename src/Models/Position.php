<?php

namespace Andreger\ChessPosition\Models;

use Andreger\ChessPosition\Services\SquareService;

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

    private $squareService;

    /**
     * Position constructor.
     *
     * @param string|null $fen
     */
    public function __construct(?string $fen = null)
    {
        $this->squareService = new SquareService();

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

    public function piece(string $algebric)
    {
        $coords = $this->squareService->algebricToCoordenate($algebric);
        return $this->squares[$coords->row][$coords->col]->piece;
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

        foreach ($this->squares as $row) {
            foreach ($row as $square) {

                if ($piece = $square->piece) {
                    $sum += $piece->isColor($color) ? $piece->value : 0;
                }
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


        $rows = array_reverse($rows);

        for ($row = 0; $row < 8; $row++) {
            $cols = str_split($rows[$row]);

            for ($col = 0; $col < 8; $col++) {
                $this->squares[$row][$col] = new Square($this, $cols[$col], $row, $col);
            }
        }

    }

}
