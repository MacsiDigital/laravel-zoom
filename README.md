# Laravel package for Zoom video conferencing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/macsidigital/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-zoom)
[![Build Status](https://img.shields.io/travis/macsidigital/laravel-zoom/master.svg?style=flat-square)](https://travis-ci.org/MacsiDigital/laravel-zoom)
[![StyleCI](https://github.styleci.io/repos/193588988/shield?branch=master)](https://github.styleci.io/repos/193588988)
[![Total Downloads](https://img.shields.io/packagist/dt/macsidigital/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-zoom)

Package to manage the Zoom API in Laravel

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-zoom
```

The service provider should automatically register for For Laravel > 5.4.

For Laravel < 5.5, open config/app.php and, within the providers array, append:

``` php
MacsiDigital\Zoom\Providers\ZoomServiceProvider::class
```

## Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Zoom\Providers\ZoomServiceProvider"
```

This will create a zoom/config.php within your config directory, where you add value for api_key and api_secret.

## Usage

Everything has been setup to be similar to Laravel syntax.  

Unfortunately the Zoom API is not very uniform and is a bit all over the place, so at the minute there are a number of hacks to be able to get this to work.  We will refactor and improve this.

We use relationships so you will need to check the Zoom API, for example to get a list of meetings or webinars you need to pass in a user id. WE use a little bit of relationship magic to acheive this in a more laravel type way.

So to get a list of meetings

``` php
	$zoom = new \MacsiDigital\Zoom\Zoom;
	$meetings = $zoom->user->find('test@domain.com')->meetings()->all();
```

## Find all

The find all function returns a Laravel Collection so you can use all the Laravel Collection magic

``` php
	$zoom = new \MacsiDigital\Zoom\Zoom;
	$users = $zoom->user->all();
```

## Filtered

There are very few ocassions in the API where you can filter the results, but where you can you can use the where function.  Again check the API documentation for where you can add a query to the request.  To action you would do like so

``` php
    $zoom = new \MacsiDigital\Zoom\Zoom;
    $thing = $zoom->thing->where('Name', '=', 'Test Name')->get();
```

You can also just passs the name and value if it is to equal

``` php
    $zoom = new \MacsiDigital\Zoom\Zoom;
    $thing = $zoom->thing->where('Name', 'Test Name')->get();
```

To only get a single item use the 'first' method

``` php
    $zoom = new \MacsiDigital\Zoom\Zoom;
    $thing = $zoom->thing->where('Name', 'Test Name')->first();
```

## Find by ID

Just like Laravel we can use the 'find' method to return a single matched result on the ID.  For users/registrants/panelists you can also use the email as well as the ID.

``` php
	$zoom = new \MacsiDigital\Zoom\Zoom;
	$meeting = $zoom->meeting->find('000000000');
```

## Creating Items

We can create and update records using the save function, below is the full save script for a creation.

``` php
	$user = $zoom->user->create([
        'name' => 'Test Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => 'secret',
        'type' => 1
    ]);
    $meeting = $user->meetings()->create([
    	'type' => '2',
    	'start_time' => '2019-06-29T20:00:00Z'
    ]);
    $registrant = $meeting->registrants()->create([
    	'email' => 'registratn@domain.com',
    	'first_name' => 'Test',
    	'last_name' => 'Registrant'
    ]);
```

There are also helper functions for adding sub objects

``` php
    $meeting = $zoom->meeting->find('000000000');
    $recurrance = $zoom->recurrance->create(['fields' => 'values']);
    $meeting->addRecurrance($recurrance);
    $meeting->save();
```

### RESOURCES

We cover the main resources

```
Meetings
Panelists
Registrants
Users
Webinars
```

But some also have sub cresources, like

```
Recurrance
Occurance
Settings (for meetings and webinars)
Tracking Fields
```

We aim to add additional resources/sub-resources over time

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