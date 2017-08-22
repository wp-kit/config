<?php

namespace WPKit\Config;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('config.finder', function () {
            return new ConfigFinder();
        });

        $this->app->singleton('config.factory', function ($container) {
            return new ConfigFactory($container['config.finder']);
        });
        
        $this->app->singleton('config', function() {
	        return $this->app['config.factory'];
        });
        
        $this->app->singleton(Repository::class, function() {
	        return $this->app['config.factory'];
        });
        
    }
}