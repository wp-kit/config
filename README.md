# wp-kit/config

This is a wp-kit component that handles config files.

```wp-kit/config``` is fully compatible with [```Themosis```](http://framework.themosis.com/) and if you are using ```Themosis``` you'll notice it already has a [```PostTypeBuilder```](https://github.com/themosis/framework/blob/master/src/Themosis/PostType/PostTypeBuilder.php) and a [```TaxonomyBuilder```](https://github.com/themosis/framework/blob/master/src/Themosis/Taxonomy/TaxonomyBuilder.php) but ```wp-kit/registry``` just simplifies the process by providing an [OOP](https://en.wikipedia.org/wiki/Object-oriented_programming) approach to registering ```PostTypes``` and ```Taxonomies```.

## Installation

If you're using ```Themosis```, install via [```Composer```](https://getcomposer.org/) in the ```Themosis``` route folder, otherwise install in your ```Composer``` driven theme folder:


```php
composer require "wp-kit/config"
```

## Setup

### Add Service Provider

Just register the service provider and facade in the providers config and theme config:

```php
//inside theme/resources/config/providers.config.php

return [
    //
    WPKit\Config\ConfigServiceProvider::class,
    //
];
```
## Usage

Simply add config files as ```theme/resources/config/*.config.php``` and reference the using the below snippet:

```php
app('config')->get('anything.key.key');
```

## Requirements

Wordpress 4+

PHP 5.6+

## License

wp-kit/config is open-sourced software licensed under the MIT License.
