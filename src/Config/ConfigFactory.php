<?php

namespace WPKit\Config;

use Illuminate\Config\Repository;

class ConfigFactory extends Repository implements IConfig
{
    /**
     * Config file finder instance.
     *
     * @var ConfigFinder
     */
    protected $finder;

    public function __construct(ConfigFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Return all or specific property from a config file.
     *
     * @param string $name The config file name or its property full name.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {

	    if( ! $this->has($key) ) {
		    
		    $parts = explode('.', $key);
		    $name = reset($parts);
		    $this->set($name, include $this->finder->find($name)->getRealPath());
	        
		}
		
		return parent::get($key, $default);

    }
    
}
