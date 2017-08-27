# wp-kit/config

This is a wp-kit component that handles config files.

```wp-kit/config``` is fully compatible with [```Themosis```](http://framework.themosis.com/). 

If you are using ```Themosis``` you'll notice it already has a [```ConfigFactory```](https://github.com/themosis/framework/blob/master/src/Themosis/Config/ConfigFactory.php) however this lacks [```ArrayAccess```](http://php.net/manual/en/class.arrayaccess.php) and only binds to ```$app['config.factory`]``` and not ```$app['config`]``` which means it is not compatible with most [```Illuminate```](https://github.com/illuminate) components. ```wp-kit/config``` solves these issues so you can benefit from using ```Illuminate``` components when using ```Themosis```.

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

Simply add config files as ```theme/resources/config/*.config.php``` and reference the below snippet to access config data in ```ArrayAccess``` fashion:

```php
app('config')->get('anything.key.key');
```

## Requirements

Wordpress 4+

PHP 5.6+

## License

wp-kit/config is open-sourced software licensed under the MIT License.
