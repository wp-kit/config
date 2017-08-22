<?php

namespace WPKit\Config;

use WPKit\Finder\Finder;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Config\Repository;

class ConfigFactory implements IConfig, Repository, \ArrayAccess
{
    /**
     * Config file finder instance.
     *
     * @var ConfigFinder
     */
    protected $finder;
    
    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = [];

    public function __construct(ConfigFinder $finder)
    {
        $this->finder = $finder;
    }
    
    /**
     * Determine if the given configuration value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key)
    {
        return Arr::has($this->items, $key);
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

        return Arr::get($this->items, $key, $default);
    }
    
    /**
     * Set a given configuration value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];
        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);
        }
    }
    
    /**
     * Determine if the given configuration option exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }
    /**
     * Get a configuration option.
     *
     * @param  string  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }
    /**
     * Set a configuration option.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }
    
    /**
     * Unset a configuration option.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->set($key, null);
    }
    
}
