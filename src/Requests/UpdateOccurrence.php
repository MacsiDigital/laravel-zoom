<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateOccurrence extends PersistResource
{
    protected $persistAttributes = [
        'start_time' => 'nullable|date',
        'duration' => 'nullable|integer',
        'agenda' => 'nullable|string|max:2000',
        'settings.host_video' => 'nullable|boolean',
        'settings.panelists_video' => 'nullable|boolean',
        'settings.hd_video' => 'nullable|boolean',
        'settings.watermark' => 'nullable|boolean',
        'settings.auto_recording' => 'nullable|boolean',
        'settings.participant_video' => 'nullable|boolean',
        'settings.join_before_host' => 'nullable|boolean',
        'settings.mute_upon_entry' => 'nullable|boolean',
        'settings.waiting_room' => 'nullable|boolean',
    ];
}
