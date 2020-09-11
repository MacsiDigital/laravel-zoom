<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class ScheduleMeeting extends Resource
{
    public function recordingPasswordRequirement()
    {
        return $this->hasOne(MeetingPasswordRequirement::class);
    }
}
