<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Recording extends Model
{
    protected $customEndPoints = [
        'get' => 'users/{user:id}/recordings',
    ];

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = 'meetings';

    public function recordingFiles()
    {
        return $this->hasMany(RecordingFile::class);
    }

    public function recordingPasswordRequirement()
    {
        return $this->hasOne(RecordingPasswordRequirement::class);
    }
}
