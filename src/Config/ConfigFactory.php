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
		    $file = reset($parts);
		    $path = $this->finder->find($file);
		    $properties = include $path;
		    $this->set($file, $properties);
	        
		}
		
		return parent::get($key, $default);

    }
    
}
