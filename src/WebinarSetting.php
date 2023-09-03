<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class WebinarSetting extends Resource
{
    public function globalDialInCountries()
    {
        return $this->hasMany(GlobalDialInCountry::class);
    }

    public function attendeesAndPanelistsReminderEmailNotification()
    {
        return $this->hasOne(EmailNotification::class);
    }
    
    public function followUpAbsenteesEmailNotification()
    {
        return $this->hasOne(EmailNotification::class);
    }
    
    public function followUpAttendeesEmailNotification()
    {
        return $this->hasOne(EmailNotification::class);
    }

    public function questionAndAnswer()
    {
        return $this->hasOne(QuestionAnswer::class);
    }
}
