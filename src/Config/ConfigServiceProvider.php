<?php

namespace WPKit\Config;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;

class ConfigServiceProvider extends ServiceProvider
{
	
	/**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	    
	    /**
		 * Clone the original ConfigFinder from Themosis
		**/
	    $cloned = $this->app->bound('config.finder') ? $this->app['config.finder'] : null;
	    
        $this->app->singleton('config.finder', function () {
            return new ConfigFinder();
        });
        
        /**
		 * Retrive paths from ConfigFinder from Themosis
		**/
        $cloned && $this->app['config.finder']->addPaths($cloned->getPaths());

        $this->app->singleton('config.factory', function ($container) {
            return new ConfigFactory($container['config.finder']);
        });
        
        /**
		 * Bind to config to ensure Illuminate compatibility
		**/
        $this->app->singleton('config', function() {
	        return $this->app['config.factory'];
        });
        
        /**
		 * Bind to Repository to ensure Illuminate compatibility
		**/
        $this->app->singleton(Repository::class, function() {
	        return $this->app['config.factory'];
        });
        
    }
    
}
