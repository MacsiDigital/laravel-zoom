<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateMeeting extends PersistResource
{
    protected $persistAttributes = [
        'topic' => 'nullable|string',
        'type' => 'nullable|integer|in:1,2,3,8',
        'start_time' => 'nullable|date',
        'duration' => 'nullable|integer',
        'timezone' => 'nullable|string',
        'password' => 'nullable|string|max:10',
        'schedule_for' => 'nullable|string',
        'agenda' => 'nullable|string|max:2000',
    ];

    protected $relatedResource = [
        "settings" => UpdateMeetingSetting::class,
        "recurrence" => UpdateRecurrence::class,
        "tracking_fields" => UpdateTrackingField::class,
    ];
}
