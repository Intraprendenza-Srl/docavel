<?php

namespace INTRA\Docavel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DocavelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('docavel', config('docavel.middleware', []));

        $this->registerRoutes();
        $this->registerPublishing();

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'docavel');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'docavel');

        if ($this->app->runningInConsole()) {
            $this->commands([
                DocavelGeneratorCommand::class,
            ]);
        }
    }

    /**
     * Get the Docavel route group configuration array.
     *
     * @return array
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../../resources/routes/docavel.php', 'docavel');
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../resources/lang' => $this->resourcePath('lang/vendor/docavel'),
            ], 'docavel-language');

            $this->publishes([
                __DIR__ . '/../../resources/views' => $this->resourcePath('views/vendor/docavel'),
            ], 'docavel-views');

            $this->publishes([
                __DIR__ . '/../../config/docavel.php' => app()->basePath() . '/config/docavel.php',
            ], 'docavel-config');
        }
    }

    /**
     * Get the Docavel route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'domain' => config('docavel.domain', null),
            'prefix' => config('docavel.path'),
            'middleware' => 'docavel',
            'as' => 'docavel.',
        ];
    }

    /**
     * Register the API doc commands.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/docavel.php', 'docavel');
    }

    /**
     * Return a fully qualified path to a given file.
     *
     * @param string $path
     *
     * @return string
     */
    public function resourcePath($path = '')
    {
        return app()->basePath() . '/resources' . ($path ? '/' . $path : $path);
    }
}
