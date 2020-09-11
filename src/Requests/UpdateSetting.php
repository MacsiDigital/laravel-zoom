<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateSetting extends PersistResource
{
    protected $relatedResource = [
        "email_notification" => UpdateEmailNotification::class,
        "feature" => UpdateFeature::class,
        "in_meeting" => UpdateInMeeting::class,
        "integration" => UpdateIntegration::class,
        "recording" => UpdateRecording::class,
        "schedule_meeting" => UpdateScheduleMeeting::class,
        "telephony" => UpdateTelephony::class,
        "tsp" => UpdateTsp::class,
    ];
}
