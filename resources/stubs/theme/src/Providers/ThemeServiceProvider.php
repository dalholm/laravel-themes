<?php

namespace DummyNamespace\Providers;

use Dalholm\Themes\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        //
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
