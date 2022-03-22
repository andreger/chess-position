<?php

namespace Andreger\ChessPosition\Models;

use Andreger\ChessPosition\Services\PieceService;

class Square
{
    public $piece;

    public $position;

    public $row;

    public $col;

    private $pieceService;

    public function __construct(Position $position, string $pieceCode, int $row, int $col)
    {
        $this->pieceService = new PieceService();

        $this->position = $position;
        $this->piece = trim($pieceCode) ? $this->pieceService->create($pieceCode, $this) : null;
        $this->row = $row;
        $this->col = $col;
    }
}
