<?php

namespace Andreger\ChessPosition\Facades;

use Illuminate\Support\Facades\Facade;

class PositionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'position';
    }
}
