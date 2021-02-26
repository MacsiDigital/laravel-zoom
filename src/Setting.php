<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Setting extends Model
{
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateSetting';

    protected $customEndPoints = [
        'get' => 'users/{user:id}/settings',
    ];

    protected $allowedMethods = ['get', 'patch'];

    protected $apiMultipleDataField = '';

    public function beforeSave($options, $query)
    {
        $this->exists = true;

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emailNotification()
    {
        return $this->hasOne(EmailNotification::class);
    }

    public function feature()
    {
        return $this->hasOne(Feature::class);
    }

    public function inMeeting()
    {
        return $this->hasOne(InMeeting::class);
    }

    public function integration()
    {
        return $this->hasOne(Integration::class);
    }

    public function recording()
    {
        return $this->hasOne(Recording::class);
    }

    public function scheduleMeeting()
    {
        return $this->hasOne(ScheduleMeeting::class);
    }

    public function telephony()
    {
        return $this->hasOne(Telephony::class);
    }

    public function tsp()
    {
        return $this->hasOne(Tsp::class);
    }

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }
}
