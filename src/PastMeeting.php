<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class PastMeeting extends Model
{
    protected $endPoint = 'past_meetings';

    protected $primaryKey = 'uuid';

    protected $allowedMethods = ['find'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'meetings';

    public function participants()
    {
        return $this->hasMany(Participant::class);
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
