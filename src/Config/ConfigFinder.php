<?php

namespace WPKit\Config;

use WPKit\Finder\Finder;

class ConfigFinder extends Finder
{
    /**
     * The file extensions.
     *
     * @var array
     */
    protected $extensions = ['config.php', 'php'];
}
