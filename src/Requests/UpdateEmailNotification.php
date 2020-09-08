<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateEmailNotification extends PersistResource
{
    protected $persistAttributes = [
        "jbh_reminder" => "nullable|boolean",
        "cancel_meeting_reminder" => "nullable|boolean",
        "alternative_host_reminder" => "nullable|boolean",
        "schedule_for_reminder" => "nullable|boolean",
    ];
}
