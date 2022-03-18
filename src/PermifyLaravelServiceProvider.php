<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/16/22
 * Time: 9:13 PM
 */

namespace Permify\PermifyLaravel;

use Illuminate\Support\ServiceProvider;

class PermifyLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'permify');
        $this->app->singleton('permify', function () {
            return (new PermifyLaravelConnector())->connect();
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('permify.php'),
            ], 'config');
        }
    }
}