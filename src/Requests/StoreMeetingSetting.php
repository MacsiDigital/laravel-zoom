<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreMeetingSetting extends PersistResource
{
    protected $persistAttributes = [
        "host_video" => "nullable|boolean",
        "participant_video" => "nullable|boolean",
        "cn_meeting" => "nullable|boolean",
        "in_meeting" => "nullable|boolean",
        "join_before_host" => "nullable|boolean",
        "mute_upon_entry" => "nullable|boolean",
        "watermark" => "nullable|boolean",
        "use_pmi" => "nullable|boolean",
        "approval_type" => "nullable|in:0,1,2",
        "registration_type" => "nullable|in:1,2,3",
        "audio" => "nullable|in:both,telephony,voip",
        "auto_recording" => "nullable|in:local,cloud,none",
        "enforce_login" => "nullable|boolean",
        "enforce_login_domains" => "nullable|string",
        "alternative_hosts" => "nullable|string",
        "close_registration" => "nullable|boolean",
        "waiting_room" => "nullable|boolean",
        "contact_name" => "nullable|string",
        "contact_email" => "nullable|string",
        "registrants_confirmation_email" => "nullable|boolean",
        "registrants_email_notification" => "nullable|boolean",
        "meeting_authentication" => "nullable|boolean",
        "authentication_option" => "nullable|string",
        "authentication_domains" => "nullable|string",
        "authentication_name" => "nullable|string",
    ];

    protected $relatedResource = [
        "global_dial_in_countries" => StoreGlobalDialInCountry::class,
        "global_dial_in_numbers" => StoreGlobalDialInNumber::class,
    ];
}
