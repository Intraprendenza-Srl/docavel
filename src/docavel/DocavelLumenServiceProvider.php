<?php

namespace INTRA\Docavel;

class DocavelLumenServiceProvider extends DocavelServiceProvider
{
    public function boot()
    {
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

    protected function registerRoutes()
    {
        app()->router->group($this->routeConfiguration(), function ($router) {
            require __DIR__ . '/../../resources/routes/lumen.php';
        });
    }

    protected function routeConfiguration()
    {
        return [
            'domain' => config('docavel.domain'),
            'prefix' => config('docavel.path'),
            'middleware' => config('docavel.middleware', []),
            'as' => 'docavel',
        ];
    }
}
