<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingRecording extends Model
{
    protected $customEndPoints = [
        'get' => 'meetings/{meeting:id}/recordings',
    ];

    protected $allowedMethods = ['get'];

    public function recordingFiles()
    {
        return $this->hasMany(RecordingFile::class);
    }

    public function recordingPasswordRequirement()
    {
        return $this->hasOne(RecordingPasswordRequirement::class);
    }
}
