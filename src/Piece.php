<?php

namespace Andreger\ChessPosition;

class Piece
{
    private $piece;

    private $color;

    private $type;

    private $value;

    public function __construct(?string $piece = null)
    {
        $this->piece = $piece;
        $this->initColor($piece);
        $this->initTypeAndValue($piece);
    }

    private function initColor(?string $piece = null)
    {
        $this->color = null;

        if ($piece != null) {
            $this->color = ctype_lower($piece) ? 'black' : 'white';
        }
    }

    private function initTypeAndValue(?string $piece = null)
    {
        switch (strtolower($piece)) {
            case 'k': {
                $this->type = 'king';
                $this->value = null;
                break;
            }
            case 'q': {
                $this->type = 'queen';
                $this->value = 3;
                break;
            }
            case 'r': {
                $this->type = 'rook';
                $this->value = 5;
                break;
            }
            case 'n': {
                $this->type = 'knight';
                $this->value = 3;
                break;
            }
            case 'b': {
                $this->type = 'bishop';
                $this->value = 3;
                break;
            }
            case 'p': {
                $this->type = 'pawn';
                $this->value = 1;
                break;
            }
            default: {
                $this->type = null;
                $this->value = null;
            }
        }
    }

    public function piece()
    {
        return $this->piece;
    }
}
