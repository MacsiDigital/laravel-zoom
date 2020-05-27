<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class Recording extends Resource
{
    public function recordingPasswordRequirement() 
    {
        return $this->hasOne(RecordingPasswordRequirement::class);
    }
}
