<?php
namespace eurostep\custom;

use Illuminate\Support\ServiceProvider;

class EurostepServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/eurostep.php' => config_path('eurostep.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/eurostep.php', 'eurostep');

        $this->app->bind('eurostep', function ($app) {
            return new Eurostep($app->config->get('eurostep'));
        });
    }

    public function boot()
    {
        // ...
    }
}
