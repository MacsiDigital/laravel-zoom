<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingSetting extends Model
{
    public function globalDialInNumbers()
    {
        return $this->hasMany(GlobalDialInNumber::class);
    }

    public function globalDialInCountries()
    {
        return $this->hasMany(GlobalDialInCountry::class);
    }
}
