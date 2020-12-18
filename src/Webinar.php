<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Webinar extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreWebinar';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateWebinar';

    protected $endPoint = 'webinars';

    protected $customEndPoints = [
        'get' => 'users/{user_id}/webinars',
        'post' => 'users/{user_id}/webinars',
    ];

    protected $allowedMethods = ['find', 'get', 'post', 'patch', 'delete'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'webinars';

    protected $dates = [
        'start_time',
        'created_at',
    ];

    public function settings()
    {
        return $this->hasOne(WebinarSetting::class, 'settings');
    }

    public function recurrence()
    {
        return $this->hasOne(Recurrence::class);
    }

    public function registrants()
    {
        return $this->hasMany(WebinarRegistrant::class);
    }
    public function participants()
    {
        return $this->hasMany(WebinarParticipant::class);
    }
    public function occurrences()
    {
        return $this->hasMany(WebinarOccurrence::class);
    }

    public function panelists()
    {
        return $this->hasMany(Panelist::class);
    }

    public function registrationQuestions()
    {
        return $this->hasMany(RegistrationQuestion::class);
    }

    public function trackingField()
    {
        return $this->hasMany(TrackingField::class);
    }

    public function trackingSources()
    {
        return $this->hasMany(TrackingSources::class);
    }

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }

    public function endWebinar()
    {
        return $this->newQuery()->sendRequest('put', ['webinars/'.$this->id.'/status', ['action' => 'end']])->successful();
    }
}
