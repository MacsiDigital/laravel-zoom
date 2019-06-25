# Laravel package for Zoom video conferencing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/macsidigital/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-zoom)
[![Build Status](https://img.shields.io/travis/macsidigital/laravel-zoom/master.svg?style=flat-square)](https://travis-ci.org/MacsiDigital/laravel-zoom)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MacsiDigital/laravel-zoom/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MacsiDigital/laravel-zoom/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/macsidigital/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-zoom)

Package to manage the Zoom API in Laravel

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-zoom
```

## Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Zoom\Providers\ZoomServiceProvider"
```

This will create a zoom/config.php within your config directory, where you add value for api_key and api_secret.

## Usage

``` php
$zoom = new Macsidigital\Zoom\Zoom();

$zoom->users->list();
```

### RESOURCES
```
Meetings
Panelists
Registrants
Users
Webinars
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email colin@macsi.co.uk instead of using the issue tracker.

## Credits

- [Colin Hall](https://github.com/macsidigital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.