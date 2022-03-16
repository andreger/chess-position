<?php

namespace Andreger\ChessPosition;

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
