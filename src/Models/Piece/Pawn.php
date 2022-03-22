<?php

namespace Andreger\ChessPosition\Models\Piece;

class Pawn
{
    public const KING = 'king';
    public const QUEEN = 'queen';
    public const ROOK = 'rook';
    public const BISHOP = 'bishop';
    public const KNIGHT = 'knight';
    public const PAWN = 'pawn';
    public const WHITE = 'white';
    public const BLACK = 'black';

    public $piece;

    public $color;

    public $type;

    public $value;

    /**
     * Piece constructor.
     *
     * @param string $piece
     */
    public function __construct(string $piece)
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
            $color = self::WHITE;
        }

        if ($color == 'b') {
            $color = self::BLACK;
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
        return $this->isColor(self::BLACK);
    }

    /**
     * Return true if piece is white
     *
     * @return bool
     */
    public function isWhite(): bool
    {
        return $this->isColor(self::WHITE);
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
            $this->color = ctype_lower($piece) ? self::BLACK : self::WHITE;
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
                $this->type = self::KING;
                $this->value = null;
                break;
            }
            case 'q': {
                $this->type = self::QUEEN;
                $this->value = 9;
                break;
            }
            case 'r': {
                $this->type = self::ROOK;
                $this->value = 5;
                break;
            }
            case 'n': {
                $this->type = self::KNIGHT;
                $this->value = 3;
                break;
            }
            case 'b': {
                $this->type = self::BISHOP;
                $this->value = 3;
                break;
            }
            case 'p': {
                $this->type = self::PAWN;
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
