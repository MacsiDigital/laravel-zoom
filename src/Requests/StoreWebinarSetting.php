<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreWebinarSetting extends PersistResource
{
    protected $persistAttributes = [
        "host_video" => "nullable|boolean",
        "panelists_video" => "nullable|boolean",
        "practice_session" => "nullable|boolean",
        "hd_video" => "nullable|boolean",
        "approval_type" => "nullable|in:0,1,2",
        "registration_type" => "nullable|in:1,2,3",
        "audio" => "nullable|in:both,telephony,voip",
        "auto_recording" => "nullable|in:local,cloud,none",
        "enforce_login" => "nullable|boolean",
        "enforce_login_domains" => "nullable|string",
        "alternative_hosts" => "nullable|string",
        "close_registration" => "nullable|boolean",
        "show_share_button" => "nullable|boolean",
        "allow_multiple_devices" => "nullable|boolean",
        "on_demand" => "nullable|boolean",
        "contact_name" => "nullable|string",
        "contact_email" => "nullable|string",
        "registrants_restrict_number" => "nullable|numeric|max:20000",
        "post_webinar_survey" => "nullable|boolean",
        "survey_url" => "nullable|string",
        "registrants_email_notification" => "nullable|boolean",
        "meeting_authentication" => "nullable|boolean",
        "authentication_option" => "nullable|string",
        "authentication_domains" => "nullable|string",
        "authentication_name" => "nullable|string",
        "email_language" => "nullable|string",
    ];

    protected $relatedResource = [
        "global_dial_in_countries" => StoreGlobalDialInCountry::class,
        "attendees_and_panelists_reminder_email_notification" => StoreEmailNotification::class,
        "follow_up_absentees_email_notification" => StoreEmailNotification::class,
        "follow_up_attendees_email_notification" => StoreEmailNotification::class,
        "question_and_answer" => StoreQuestionAnswer::class,
    ];
}
