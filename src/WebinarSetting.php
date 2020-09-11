<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class WebinarSetting extends Resource
{
    public function globalDialInCountries()
    {
        return $this->hasMany(GlobalDialInCountry::class);
    }
}
