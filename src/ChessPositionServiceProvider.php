<?php

namespace Andreger\ChessPosition;

use Andreger\ChessPosition\Models\Position;
use Illuminate\Support\ServiceProvider;

class ChessPositionServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('position', function() {
            return new Position();
        });
    }
}
