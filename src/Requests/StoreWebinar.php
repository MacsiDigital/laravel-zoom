<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreWebinar extends PersistResource
{
    protected $persistAttributes = [
        'topic' => 'nullable|string',
        'type' => 'nullable|integer|in:5,6,9',
        'start_time' => 'nullable|date',
        'duration' => 'nullable|integer',
        'timezone' => 'nullable|string',
        'password' => 'nullable|string|max:10',
        'agenda' => 'nullable|string|max:2000',
    ];

    protected $relatedResource = [
        "settings" => StoreWebinarSetting::class,
        "recurrence" => StoreRecurrence::class,
        "tracking_fields" => StoreTrackingField::class,
    ];
}
