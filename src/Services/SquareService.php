<?php


namespace Andreger\ChessPosition\Services;


class SquareService
{
    public function algebricToCoordenate(string $algebric): object
    {
        $algebric = str_split($algebric);

        switch ($algebric[0]) {
            case 'a': $col = 0; break;
            case 'b': $col = 1; break;
            case 'c': $col = 2; break;
            case 'd': $col = 3; break;
            case 'e': $col = 4; break;
            case 'f': $col = 5; break;
            case 'g': $col = 6; break;
            case 'h': $col = 7; break;
        }

        return (object)[
            'row' => $algebric[1] - 1,
            'col' => $col
        ];
    }

    public function coordinateToAlgebric(int $row, int $col): string
    {
        switch ($col) {
            case 0: $col = 'a'; break;
            case 1: $col = 'b'; break;
            case 2: $col = 'c'; break;
            case 3: $col = 'd'; break;
            case 4: $col = 'e'; break;
            case 5: $col = 'f'; break;
            case 6: $col = 'g'; break;
            case 7: $col = 'h'; break;
        }

        return $col . ($row + 1);
    }
}
