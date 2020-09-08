<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class PastWebinar extends Model
{
    protected $endPoint = 'past_webinars';

    protected $primaryKey = 'uuid';

    protected $allowedMethods = ['find'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'webinars';

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function absentees()
    {
        return $this->hasMany(Absentees::class);
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }

    public function files()
    {
        return $this->hasMany(File::class, 'in_meeting_files');
    }

    public function poll()
    {
        return $this->hasOne(PollResult::class);
    }
}
