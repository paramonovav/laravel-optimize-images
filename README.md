Optimize Images
================
[![Latest Stable Version](https://poser.pugx.org/paramonovav/laravel-optimize-images/v/stable)](https://packagist.org/packages/paramonovav/laravel-optimize-images) [![Total Downloads](https://poser.pugx.org/paramonovav/laravel-optimize-images/downloads)](https://packagist.org/packages/paramonovav/laravel-optimize-images) [![Latest Unstable Version](https://poser.pugx.org/paramonovav/laravel-optimize-images/v/unstable)](https://packagist.org/packages/paramonovav/laravel-optimize-images) [![License](https://poser.pugx.org/paramonovav/laravel-optimize-images/license)](https://packagist.org/packages/paramonovav/laravel-optimize-images)

Artisan command for Laravel 4 to optimize your images using [jpegoptim](http://freecode.com/projects/jpegoptim ) and [optipng](http://optipng.sourceforge.net/).

*Note*: Based on and inspired by [Spir/ImageOptimize](https://gist.github.com/Spir/5650030).

## Installation

Require this package with composer:

```
composer require paramonovav/laravel-optimize-images
```

After updating composer, add the ServiceProvider to the providers array in app/config/app.php

```
'Paramonovav\LaravelOptimizeImages\LaravelOptimizeImagesServiceProvider',
```

You need to publish the config from this package.

```
php artisan config:publish paramonovav/laravel-optimize-images
```

### Installation "jpegoptim" and "optipng" on MacOS X

Installing with [brew](http://brew.sh/)

```
brew install jpegoptim optipng
```

### Installation "jpegoptim" and "optipng" on CentOS with yum

Installing with yum package manager

```
yum install jpegoptim optipng -y
```

Now you can run artisan command:

```
php artisan optimize:images
```

> *Note*: Be CAREFUL optimized images override/replace the original images
