<?php

namespace Dalholm\Themes;

use View;
use Dalholm\Themes\Manifest;
use Illuminate\Support\ServiceProvider;
use Dalholm\Themes\View\ThemeViewFinder;
use Dalholm\Themes\Console\GenerateTheme;

class ThemesServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the service provider.
	 *
	 * @return null
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/themes.php' => config_path('themes.php'),
		], 'laravel-themes-config');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(
		    __DIR__.'/../config/themes.php', 'themes'
		);

		$this->registerServices();
		$this->registerNamespaces();

        $this->commands([
            GenerateTheme::class
        ]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
	public function provides()
	{
		return ['laravelthemes.themes', 'view.finder'];
	}

	/**
	 * Register the package services.
	 */
	protected function registerServices()
	{
		$this->app->singleton('laravelthemes.themes', function($app) {
            $themes = [];
            $items  = [];

            if ($path = base_path('themes')) {
                if (file_exists($path) && is_dir($path)) {
                    $themes = $this->app['files']->directories($path);
                }
			}

            foreach ($themes as $theme) {
                $manifest = new Manifest($theme.'/theme.json');
                $items[]  = collect($manifest->all());
            }

            return new Theme($items);
		});

        $this->app->singleton('view.finder', function($app) {
            return new ThemeViewFinder($app['files'], $app['config']['view.paths'], null);
		});
	}

    /**
     * Register the theme namespaces.
     */
    protected function registerNamespaces()
    {
        $themes = app('laravelthemes.themes')->all();

        foreach ($themes as $theme) {
            $namespace = $theme->get('slug');
			$hint      = app('laravelthemes.themes')->path('resources/views', $theme->get('slug'));

            app('view')->addNamespace($namespace, $hint);
        }
	}
}
