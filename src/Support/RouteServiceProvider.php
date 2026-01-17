<?php

namespace Nyehandel\Themes\Support;

use Nyehandel\Themes\Concerns\GetsManifest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;

class RouteServiceProvider extends LaravelRouteServiceProvider
{
    use GetsManifest;
}
