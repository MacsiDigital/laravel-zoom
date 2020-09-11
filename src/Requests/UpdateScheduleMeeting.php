<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateScheduleMeeting extends PersistResource
{
    protected $persistAttributes = [
        "host_video" => "nullable|boolean",
        "participants_video" => "nullable|boolean",
        "audio_type" => "nullable|in:both,telephony,voip,thirdParty",
        "join_before_host" => "nullable|boolean",
        "use_pmi_for_scheduled_meetings" => "nullable|boolean",
        "use_pmi_for_instant_meetings" => "nullable|boolean",
        "enforce_login_with_domains" => "nullable|boolean",
        "enforce_login_domains" => "nullable|boolean",
        "not_store_meeting_topic" => "nullable|boolean",
        "force_pmi_jbh_password" => "nullable|boolean",
        "require_password_for_instant_meetings" => "nullable|boolean",
        "require_password_for_pmi_meetings" => "nullable|in:jbh_only,all,none",
        "require_password_for_scheduling_new_meetings" => "nullable|boolean",
        'require_password_for_scheduled_meetings' => "nullable|boolean",
        "pmi_password" => "nullable|string",
        "pstn_password_protected" => "nullable|boolean",
        "default_password_for_scheduled_meetings" => "nullable|string",
        "personal_meeting" => "nullable|boolean",
    ];

    protected $relatedResource = [
        "meeting_password_requirement" => UpdateMeetingPasswordRequirement::class,
    ];
}
