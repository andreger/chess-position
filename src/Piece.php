<?php

namespace Andreger\ChessPosition;

class Piece
{
    public $piece;

    public $color;

    public $type;

    public $value;

    /**
     * Piece constructor.
     *
     * @param string|null $piece
     */
    public function __construct(?string $piece = null)
    {
        $this->piece = $piece;
        $this->initColor($piece);
        $this->initTypeAndValue($piece);
    }

    /**
     * Check if a piece is white or black
     *
     * @param string $color Supported values: white, black, w, b
     * @return bool
     */
    public function isColor(string $color): bool
    {
        if ($color == 'w') {
            $color = 'white';
        }

        if ($color == 'b') {
            $color = 'black';
        }

        return $this->color == $color;
    }

    /**
     * Return true if piece is black
     *
     * @return bool
     */
    public function isBlack(): bool
    {
        return $this->isColor('black');
    }

    /**
     * Return true if piece is white
     *
     * @return bool
     */
    public function isWhite(): bool
    {
        return $this->isColor('white');
    }

    /**
     * Set color parameter
     *
     * @param string|null $piece
     */
    private function initColor(?string $piece = null)
    {
        $this->color = null;

        if ($piece != null) {
            $this->color = ctype_lower($piece) ? 'black' : 'white';
        }
    }

    /**
     * Set type and value parameters
     *
     * @param string|null $piece
     */
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
                $this->value = 9;
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

}
