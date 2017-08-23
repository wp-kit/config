<?php

namespace WPKit\Config;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
	    
	    $cloned = $this->app->bound('config.finder') ? $this->app['config.finder'] : null;
	    
        $this->app->singleton('config.finder', function () {
            return new ConfigFinder();
        });
        
        $cloned && $this->app['config.finder']->addPaths($cloned->getPaths());

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
