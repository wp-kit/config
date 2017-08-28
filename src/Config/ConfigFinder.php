<?php

namespace WPKit\Config;

use Symfony\Component\Finder\Finder;
use Exception;

class ConfigFinder
{
	
	/**
     * The array of folders to check for config giles
     *
     * @var array
     */
	protected $folders = array();
    
    /**
     * Register multiple file folders.
     * 
     * @param array $folders
     *
     * @return $this
     */
    public function addPaths(array $folders)
    {
        $this->folders = array_unique(array_merge($this->folders, $folders));

        return $this;
    }
    
    /**
     * Returns the file path.
     *
     * @param string $name The file name or relative path.
     *
     * @return string
     *
     * @throws FinderException
     */
    public function find($name)
    {
        if (isset($this->files[$name])) {
            return $this->files[$name];
        }
        
        $files = new Finder();
        
        $files = $files->in($this->folders)->name($name . '.config.php');
                
        foreach($files as $file) {
	        
	        return $this->files[$name] = $file;
	        
        }
        
        throw new Exception('File or entity "'.$name.'" not found.');
        
    }
    
}
