# Laravel Zoom

## Laravel Zoom API Client

![Header Image](https://github.com/MacsiDigital/repo-design/raw/master/laravel-zoom/header.png)

<p align="center">
 <a href="https://github.com/MacsiDigital/laravel-zoom/actions?query=workflow%3ATests"><img src="https://github.com/MacsiDigital/laravel-zoom/workflows/Tests/badge.svg" style="max-width:100%;"  alt="tests badge"></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-zoom"><img src="https://img.shields.io/packagist/v/macsidigital/laravel-zoom.svg?style=flat-square" alt="version badge"/></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-zoom"><img src="https://img.shields.io/packagist/dt/macsidigital/laravel-zoom.svg?style=flat-square" alt="downloads badge"/></a>
</p>

Laravel Zoom API Package

## Support us

We invest a lot in creating [open source packages](https://macsidigital.co.uk/open-source), and would be grateful for a [sponsor](https://github.com/sponsors/MacsiDigital) if you make money from your product that uses them.

## Our API mission!

Let's be honest, API's are all over the place and so inconsistent.  We are therefore setting out to try to change this for all Laravel user's who need an API client and have developed an [API Client Library](https://github.com/MacsiDigital/laravel-api-client), which our API's are built on top of, to give a common set of consistent functionality.

## Updates & Issues

We only accept Issues through [Github](https://github.com/MacsiDigital/laravel-zoom)

We update security and bug fixes as soon as we can, other pull requests and enhancements will be as and when we can do them.

You can follow us on Twitter where we will post any major updates. [MacsiDigital Twitter](https://twitter.com/MacsiDigital)

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-zoom
```

For versioning:-

- 1.0 - deprecated - was a quick build for a client project, not recommended you use this version.

- 2.0 - Laravel 5.5 - 5.8 - deprecated, no longer maintained

- 3.0 - Laravel 6.0 - Maintained, feel free to create pull requests.  This is open source which is a 2 way street.

- 4.0 - Laravel 7.0 - 8.0 - Maintained, feel free to create pull requests.  This is open source which is a 2 way street.

### Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Zoom\Providers\ZoomServiceProvider"
```

This will create a zoom.php config file within your config directory:-

```php
return [
    'apiKey' => env('ZOOM_CLIENT_KEY'),
    'apiSecret' => env('ZOOM_CLIENT_SECRET'),
    'baseUrl' => 'https://api.zoom.us/v2/',
    'token_life' => 60 * 60 * 24 * 7, // In seconds, default 1 week
    'authentication_method' => 'jwt', // Only jwt compatible at present
    'max_api_calls_per_request' => '5' // how many times can we hit the api to return results for an all() request
];
```

You need to add ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET into your .env file.

Also note the tokenLife, there were numerous users of the old API who said the token expired to quickly, so we have set for a longer lifeTime by default and more importantly made it customisable.

That should be it.

## Usage

Everything has been set up to be similar to Laravel syntax. So hopefully using it will be similar to Eloquent, right down to relationships.

Unfortunately the Zoom API is not very uniform and is a bit all over the place.  But we have hopefully made this uniform and logical. However you will still need to read the [Zoom documentation](https://marketplace.zoom.us/docs/api-reference/introduction) to know what is and isn't possible.

At present we cover the following modules

- Users
- Roles
- Meetings
- Past Meetings
- Webinars
- Past Webinars
- Recordings

Doesn't look like a lot but Meetings and Webinars are the 2 big modules and includes, polls, registration questions, registrants, panelists and various other relationships.

Also note that some of the functionality is only available to certain plan types.  Check the [Zoom documentation](https://marketplace.zoom.us/docs/api-reference/introduction).

### Connecting

To get an access point you can simply create a new instance and the resource.

``` php
    $user = Zoom::user();
```

### Accessing models

There are 2 main ways to work with models, to call them directly from the access entry point via a facade, or to call them in the standard php 'new' method and pass in the access entry point

``` php
    $user = Zoom::user();

    //or
    
    $zoom = new \MacsiDigital\Zoom\Support\Entry;
    $user = new \MacsiDigital\Zoom\User($zoom);
```

### Custom settings
If you would like to use different configuration values than those in your zoom.php config file, you can feed those as parameters to \MacsiDigital\Zoom\Support\Entry as shown below.
``` php
    $zoom = new \MacsiDigital\Zoom\Support\Entry($apiKey, $apiSecret, $tokenLife, $maxQueries, $baseUrl);
```

### Working with models

As noted we are aiming for functionality similar to Laravel, so most things that you can do in Laravel you can do here, with exception to any database specific functionality, as we are not using databases.

``` php
    $user = Zoom::user()->create([...]);

    $user = Zoom::user()->find(...);

    $users = Zoom::user()->all();

    $meetings = Zoom::user()->find(...)->meetings;

    // Even this
    
    $user = Zoom::user()->find(...); 
    $meeting = Zoom::meeting()->make([...]);
    $user->meetings()->save($meeting);
```

Each model may also have some custom functions where Zoom has some unique functionality. We try to list all this below, under Resources.

``` php
    $user = Zoom::user()->create([...]);

    $user->updateProfilePicture($image); // Path to image
```

### Common get functions

#### First

We utilise the first function to return the first record from the record set.  This will return an instantiated model.

``` php
    $user = Zoom::user()->where('status', 'active')->first();
```

#### Find

We utilise the find function to return a record by searching for it by a unique attribute.  This will return an instantiated model.

``` php
    $user = Zoom::user()->find('id');

    //or

    $user = Zoom::user()->find('email@address.com');

    // for most models this is only the id.  The past models utilise the uuid instead of the id.
```

#### All

The find all function returns a customised Laravel Collection, which we call a resultset.

``` php
  $users = Zoom::user()->all();
```

When calling the all function we will make up to 5 API calls to retrieve all the data, so 5 x 300 records (the max allowed), i.e. up to 1500 records per request. This can be amended in the config by updating 'max_api_calls_per_request'.

More info below in ResultSets.

#### Get

We utilise the get function when we want to retrieve filtered records.  Note that Zoom doesn't offer much in the way of filters. So check the documentation.

``` php
    $users = Zoom::user()->where('status', 'active')->get();

    // We can also pass
    
    $users = Zoom::user()->where('status', '=', 'active')->get();
```

When using the get call we will automatically paginate results, which by default is 30 records.  You can increase/decrease this by calling the paginate function.

``` php
    $users = Zoom::user()->where('status', 'active')->paginate(100)->get(); // will return 100 records
``` 

You can disable the pagination, so it behaves the same as the all() function

``` php
    $users = Zoom::user()->where('status', 'active')->setPaginate(false)->setPerPage(300)->get(); // will return 300 records * 5 request (or amount set in config) = 1500 records
```

#### resultSet

The all and get functions return a resultSet which is an enhanced Laravel Collection. Like collections, we can call the toArray and toJson functions, which places the data in a 'data' field and adds some meta information on total records and page information.

``` php
    // toArray()
    array:5 [
        "current_page" => 1
        "data" => array:5 [
            0 => array:11 [
              "uuid" => "...."
              "id" => ....
              "host_id" => "...."
              "topic" => "Team managers meeting"
              "type" => 2
              "start_time" => "2020-05-09T14:00:00+00:00"
              "duration" => 180
              "timezone" => "Europe/London"
              "created_at" => "2020-05-09T12:34:23+00:00"
              "join_url" => "https://zoom.us/j/...."
              "user_id" => "...."
            ]
            1 => array:11 [
              "uuid" => "...."
              "id" => ....
              "host_id" => "...."
              "topic" => "Onboarding meeting with Rosie Doe"
              "type" => 2
              "start_time" => "2020-05-10T13:30:00+00:00"
              "duration" => 180
              "timezone" => "Europe/London"
              "created_at" => "2020-05-10T13:19:41+00:00"
              "join_url" => "https://zoom.us/j/...."
              "user_id" => "...."
            ]
            2 => array:11 [
              "uuid" => "...."
              "id" => ....
              "host_id" => "...."
              "topic" => "Property tracking application meeting"
              "type" => 2
              "start_time" => "2020-05-14T15:30:00+00:00"
              "duration" => 60
              "timezone" => "Europe/London"
              "created_at" => "2020-05-14T08:45:32+00:00"
              "join_url" => "https://zoom.us/j/...."
              "user_id" => "...."
            ]
            3 => array:11 [
              "uuid" => "...."
              "id" => ....
              "host_id" => "...."
              "topic" => "Marketing meeting with John Doe"
              "type" => 2
              "start_time" => "2020-05-22T09:30:00+00:00"
              "duration" => 60
              "timezone" => "Europe/London"
              "created_at" => "2020-05-22T08:11:06+00:00"
              "join_url" => "https://zoom.us/j/...."
              "user_id" => "...."
            ]
            4 => array:11 [
              "uuid" => "...."
              "id" => ....
              "host_id" => "...."
              "topic" => "New Meeting Test"
              "type" => 2
              "start_time" => "2020-05-28T16:00:00+00:00"
              "duration" => 60
              "timezone" => "Europe/London"
              "created_at" => "2020-05-26T14:38:15+00:00"
              "join_url" => "https://zoom.us/j/...."
              "user_id" => "...."
            ]
        ]
        "last_page" => 1
        "per_page" => 1500
        "total" => 5
    ]

```

There are a few additional helper functions.

If our data set is larger than the returned records then we call the nextPage() function to return the next page of records.

```php
    $meetings->nextPage();
```

We can then also navigate back a page by calling the previousPage() function.  When doing this we will return cached results rather than querying the API.

```php
    $meetings->previousPage();
```

There is also a function to accumulate more records, if you call the getNextRecords() function it will retrieve the next 1500 results and add them to the current records, so you can then run through 3000 records if required.

```php
    $meetings->getNextRecords();
```

It is not advisable to mix the page navigation with the accumulating records function.

There are also a number of helper functions.

```php
    $meetings->hasMorePages();
    $meetings->isFirstPage();
    $meetings->totalRecords();
    $meetings->currentPage();
    $meetings->lastPage();
    $meetings->nextPageNumber();
    $meetings->previousPageNumber();
    $meetings->firstPage(); // returns first page number which in this case will always be 1
    $meetings->perPage(); // returns how many results we return per page
```

As noted above we are using collections as the base for the record sets, so anything that is possible in collections is possible here.  As Zoom's ability to filter is limited we can use the collections 'where' function for example.

### Persisting Models

Again, the aim is to be similar to laravel, so you can utilise the save, create, update and make methods.

#### Save

To save a model we will use the save method, this will determine if the model is a new model or an existing and insert or update the model as needed.

``` php
    $user = Zoom::user()->find('id');

    $user->first_name = 'changed';

    $user->save();
```

#### Create

Currently, only the User model and Role model can be created directly, most other models need to be created as part of a relationship, see below for details.

To create a user.

``` php
  Zoom::user()->create([
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => 'secret'
    ]); 
    // will return the created model so you can capture it if required.
    $user = Zoom::user()->create([
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => 'secret'
    ]); 
```

#### Make

Make is similar to create except it will not persist the model to the API.  This is handy for relationship models, more on this below.

``` php
    $meeting = Zoom::meeting()->make([...]); 

    Zoom::user()->find('id')->meetings()->save($meeting); 
```

#### Update

We can also mass update attributes.

``` php
    $user = Zoom::user()->find('id')->update(['field' => 'value', 'another_field' => 'value']);
```

### Relationships

A major change to the newer versions of our API client is we use Relationships similar to Laravel. To retrieve all meetings associated to a user we would call like so.

```php
    $meetings = Zoom::user()->find(...)->meetings;
```

In the Zoom API some relationships get returned direct with the parent model, some we have to make additional API calls for (this is worthwhile knowing for performance reasons and API rate limits).

Its also worth pointing out that we are returning the resultset by calling ->meetings.  If we call the function ->meetings() we receive the relationship object which can be further queried.

```php
    $meetings = Zoom::user()->find(...)->settings(); // Returns HasOne relationship model

    $meetings = Zoom::user()->find(...)->meetings(); // Returns HasMany relationship model
```

The later is handy when we need to filter results

```php
    $meetings = Zoom::user()->find(...)->meetings()->where('type', 'scheduled')->get();
```

As noted above, Zoom has very limited queryable filters, so check with the Zoom documentation.

#### Save & Create

We can utilise the create and save functions on the relationship model to create models that require a relationship.

``` php
    // Save Method

    $meeting = Zoom::meeting()->make([...]); 
    Zoom::user()->find('id')->meetings()->save($meeting); 

    // Create Method

    Zoom::user()->find('id')->meetings()->create([...]);
```

We can also utilise the Make and Attach methods for creating and attaching models to a parent without persisting the model.  This is handy for attaching sub models that need to save as part of the parent.

``` php
    // Create Method

    $meeting = Zoom::user()->find('id')->meetings()->make([...]); 

    $meeting->recurrence()->make([...]); // will attach to parent but not persist

    $meeting->save() // will save meeting and the attached recurrence model.

    // Attach Method

    $meeting = Zoom::meeting()->create([...]); 

    $recurrence = Zoom::meeting()->recurrence()->make([...]);
    $meeting->attach($recurrence);  // will attach to parent but not persist

    $meeting->save() // will save meeting and the attached recurrence model.

    // The later is very uncommon in Zoom and unlikely to be used due to the setup of relationships, but is an option.
```

### Validation

Validation is built into the API where possible, and will throw an exception if there are validation errors.  If our own validation fails and the Zoom request returns an error, then we will throw a HTTP exception.

If Validation in the API changes or something is not working, then the best is to amend the request object for the failing model and submit a pull request.

### Resources

We give a brief overview of the common models, we have not included any validation requirements, you will need to check documentation for this.

#### Roles

``` php
    //To get a new instance
    
    Zoom::role();

    // available retrieve functions
     
    $role->find($id); // by id
    $role->all();
    $role->get();
    $role->first();

    // No available queries

    // Relationships
    $role->members // HasMany relationship, returns all users with role
    $role->privileges // hasOne relationship, list of all privileges

    // Special functions
     
    // Assign and remove role from users
    $role->giveRoleTo($user)
    $role->removeRoleFrom($user)

    // delete
    $role->delete(); // Delete (destroy) role.
```

#### Users

This is the main access for most models in Zoom.

``` php
    //To get a new instance
    
    Zoom::user();

    // available retrieve functions
     
    Zoom::user()->find('test@example.com'); // by id or email
    Zoom::user()->all();
    Zoom::user()->get();
    Zoom::user()->first();

    // Available queries
     
    Zoom::user()->where('type', 'active')->get(); // Allowed values active, inactive and pending
    Zoom::user()->where('role_id', *id*)->get(); // Allowed values are from the Roles model.

    // Relationships
    $user->setting // HasOne relationship
    $user->meetings // HasMany relationship
    $user->webinars // HasMany relationship
    $user->assistants // hasMany relationship
    $user->schedulers // hasMany relationship
    $user->permission // hasOne relationship
    $user->token // hasOne relationship
    $user->recordings // hasMany relationship

    // Special functions
     
    // To set license type
    $user->setBasic()
    $user->setLicensed()
    $user->setOnPrem()

    // Update functions
    $user->updateProfilePicture($image) // should pass the path to the image
    $user->updateStatus($status); // Allowed values active, deactivate
    $user->updatePassword($password); 
    $user->updateEmail($email);

    // disassociate & delete
    $user->disassociate(); // Disassociate from current account, user can still login to their own account.
    $user->delete(); // Delete (destroy) user.
```

##### User Settings

``` php
    //To get a new instance
    
    Zoom::setting();

    // can only be retrieved through a user
     
    $user->settings; 

    // To get sub relations then call the relationship of the setting
    
    $user->settings->scheduleMeeting;
    $user->settings->emailNotification;
    $user->settings->feature;
    $user->settings->inMeeting;
    $user->settings->integration;
    $user->settings->recording;
    $user->settings->telephony;
    $user->settings->tsp;

    // To update a setting
     
    $settings = $user->settings;
    $settings->scheduleMeeting->host_video = false;
    $settings->save();

    // Available queries
     
    $user()->settings()->where('login_type', '0')->get(); // Allowed values 0 => facebook, 1 => google, 99 => API, 100 => Zoom, 101 => SSO
    // Below not yet setup
    // $user()->settings()->where('option', 'meeting_authentication')->get(); // Allowed values meeting_authentication, recording_authentication.
```

#### Meetings

``` php
    //To get a new instance
    
    $meeting = Zoom::meeting();

    // To create we have to go through a user model
     
    $meeting = Zoom::user()->find(id)->meetings()->create([...]);

    $meeting = Zoom::meeting()->make([...]);
    $user = Zoom::user()->find(id)->meetings()->save($meeting);

    // To create a recurring meeting, this is just an example, you need to consult documentation to get the settings you require
    
    $meeting = Zoom::meeting()->make([
      'topic' => 'New meeting',
      'type' => 8,
      'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
    ]);

    $meeting->recurrence()->make([
      'type' => 2,
      'repeat_interval' => 1,
      'weekly_days' => 2,
      'end_times' => 5
    ]);

    $meeting->settings()->make([
      'join_before_host' => true,
      'approval_type' => 1,
      'registration_type' => 2,
      'enforce_login' => false,
      'waiting_room' => false,
    ]);

    $user->meetings()->save($meeting);

    // To retrieve multiple records we need to go through the user model

    $user->meetings()->all();
    $user->meetings;  // same as above
    $user->meetings()->get();
    $user->meetings()->first();

    // available retrieve functions
     
    $meeting->find(id); // by id

    // We can update direct
    
    Zoom::meeting()->find(id)->update([...]);

    // or by using save function
    // 
    $meeting->save();

    // Available queries
     
    $user->meetings()->where('type', 'scheduled')->get(); // Allowed values scheduled, live and upcoming

    // Relationships
    $meeting->registrants // HasMany relationship
    $meeting->setting // HasOne relationship
    $meeting->invitation // HasOne relationship
    $meeting->occurrences // hasMany relationship
    $meeting->recurrence // hasOne relationship
    $meeting->polls // hasMany relationship
    $meeting->liveStream // hasOne relationship
    $meeting->registrationQuestions // hasMany relationship
    $meeting->trackingFields // hasMany relationship
    $meeting->recording // hasOne relationship

    // Once we have the meeting we can update registrants
     
    $registrant = Zoom::meeting()->registrants()->create([...]);

    // or
     
    $registrant = Zoom::meetingRegistrant()->make([...]);
    $meeting->registrants()->save($registrant);
    
    // To retrieve occurrences, Zoom requires both meeting and occurrence ID's, so we have to 
    // first retrieve the meeting
     
    $occurrence = Zoom::meeting()->find('...')->occurrences()->find('...');

    // You can then register people to that occurrence
     
    $registrant = Zoom::meetingRegistrant()->make([...]);
    
    $occurrence->registrants()->save($registrant);

    // Special functions
     
    // End Meeting
    $meeting->endMeeting();

    // delete
    $meeting->delete($scheduleForReminder); // Delete (destroy) meeting. ScheduleForReminder true by default

    //Delete Meeting Recording
    $meeting->recording->delete();  //Delete (destroy) the recording of the meeting.
```

#### Webinars

``` php
    //To get a new instance
    
    $webinar = Zoom::webinar();

    // To create we have to go through a user model
     
    $webinar = Zoom::user()->find(id)->webinars()->create([...]);

    $webinar = Zoom::webinar()->make([...]);
    $user = Zoom::user()->find(id)->webinars()->save($webinar);
    
    // To create a recurring meeting, this is just an example, you need to consult documentation to get the settings you require
    
    $webinar = Zoom::webinar()->make([
      'topic' => 'New webinar',
      'type' => 8,
      'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
    ]);

    $webinar->recurrence()->make([
      'type' => 2,
      'repeat_interval' => 1,
      'weekly_days' => 2,
      'end_times' => 5
    ]);

    $webinar->settings()->make([
      'approval_type' => 1,
      'registration_type' => 2,
      'enforce_login' => false,
    ]);

    $user->webinars()->save($webinar);

    // To retrieve multiple records we need to go through the user model

    $user->webinars()->all();
    $user->webinars;  // same as above
    $user->webinars()->get();
    $user->webinars()->first();

    // available retrieve functions
     
    $webinar->find(id); // by id

    // We can update direct
    
    Zoom::webinar()->find(id)->update([...]);

    // or use the save function
    
    $webinar->save();

    // Relationships
    $webinar->registrants // HasMany relationship
    $webinar->panelists // HasMany relationship
    $webinar->setting // HasOne relationship
    $webinar->invitation // HasOne relationship
    $webinar->occurrences // hasMany relationship
    $webinar->recurrence // hasOne relationship
    $webinar->polls // hasMany relationship
    $webinar->registrationQuestions // hasMany relationship
    $webinar->trackingSources // hasMany relationship
    $webinar->trackingFields // hasMany relationship

    // To retrieve an occurrence, Zoom requires both webinar and occurnce ID's, so we have to 
    // first retrieve the webinar
     
    $occurrence = Zoom::webinar()->find('...')->occurrences()->find('...');

    // You can retrieve all occurrences
    
    $occurrence = Zoom::webinar()->find('...')->occurrences;

    // Once we have the webinar we can update registrants / panelists
     
    $registrant = Zoom::webinarRegistrant()->create([...]);

    $webinar->registrants()->save($registrant);

    $registrant = Zoom::panelist()->create([...]);

    $webinar->panelists()->save($panelist);

    // Special functions
     
    // End Webinar
    $webinar->endWebinar()

    // delete
    $webinar->delete(); // Delete (destroy) webinar.
```

#### Meeting/Webinar Occurrences

We are showing info for meeting, you will need to switch out meeting to webinar for webinars.

``` php
    // cant be instantiated or created directly, has to be created by setting up a recurrence
    // model on Meeting/Webinar Creation
    //
    // To retrieve occurrences we need to go through the meeting/webinar model, 
    // 
    // Only try to retrieve for a meeting/webinar that recurs, otherwise you will just get returned a
    // meeting/webinar model which will throw an error.

    $meeting->occurrences; // returns MeetingOccurrence model / WebinarOccurrences model

    // To get an occurrence

    $occurrence = $meeting->occurrences()->find(*id*); // Returns an Occurence model

    // Once we have the recurrence we can update registrants / panelists to that occurrence instance
     
    $registrant = Zoom::meetingRegistrant()->create([...]);

    $occurrence->registrants()->save($registrant);

    // Relationships
    $occurrence->registrants // HasMany relationship (meeting only)

    // An occurrence can also be updated directly
    $occurrence->save(); // update only, can't be created directly.
    
    // Single occurrences can also be deleted
    $occurrence->delete();
```

#### Meeting/Webinar Settings

We are showing info for meeting, you will need to switch out meeting to webinar for webinars.

``` php
    //To get a new instance
    
    $settings = Zoom::meetingSetting();

    // To create we have to go through a meeting model
     
    $setting = $meeting->settings()->create([...]);

    $settings = Zoom::meetingSetting()->make([...]);
    $meeting = $meeting->settings()->save($settings);

    // To retrieve settings we need to go through the meeting model

    $meeting->settings; // returns MeetingSetting model / WebinarSettings model

    // Relationships
    $setting->globalDialInNumbers // HasMany relationship (meeting only)
    $setting->globalDialInCountries // HasMany relationship
```

#### Past Meetings

Coming soon


#### Past Webinars

Coming soon

## To Do's

- Documentation Site
- Documentation for other Meeting/Webinar relationships
- Documentation for Past Meetings & Past Webinars
- OAuth2 implementation
- Tests

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email [info@macsi.co.uk](mailto:info@macsi.co.uk) instead of using the issue tracker.

## Credits

- [Colin Hall](https://github.com/colinhall17)
- [MacsiDigital](https://github.com/MacsiDigital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
