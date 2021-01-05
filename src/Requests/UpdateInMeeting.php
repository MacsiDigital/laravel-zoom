<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateInMeeting extends PersistResource
{
    protected $persistAttributes = [
        "e2e_encryption" => "nullable|boolean",
        "chat" => "nullable|boolean",
        "private_chat" => "nullable|numeric",
        "auto_saving_chat" => "nullable|boolean",
        "entry_exit_chime" => "nullable|in:host,all,none",
        "record_play_voice" => "nullable|boolean",
        "feedback" => "nullable|boolean",
        "co_host" => "nullable|boolean",
        "polling" => "nullable|boolean",
        "attendee_on_hold" => "nullable|boolean",
        "show_meeting_control_toolbar" => "nullable|boolean",
        "annotation" => "nullable|boolean",
        "remote_control" => "nullable|boolean",
        "non_verbal_feedback" => "nullable|boolean",
        "breakout_room" => "nullable|boolean",
        "remote_support" => "nullable|boolean",
        "closed_caption" => "nullable|boolean",
        "group_hd" => "nullable|boolean",
        "virtual_background" => "nullable|boolean",
        "far_end_camera_control" => "nullable|boolean",
        "custom_data_center_regions" => "nullable|boolean",
        "waiting_room" => "nullable|boolean",
        "guest_only_to_place_in_waiting_room" => "nullable|boolean",
        "allow_live_streaming" => "nullable|boolean",
        "auto_admit_participants_with_specified_domains" => "nullable|boolean",
        "admit_participants_with_specified_domains" => "nullable|string",
        "workplace_by_facebook" => "nullable|boolean",
        "custom_live_streaming_service" => "nullable|boolean",
        "custom_service_instructions" => "nullable|string",
        "show_meeting_control_toolbar" => "nullable|boolean",
        "custom_data_center_regions" => "nullable|boolean",
        "data_center_regions" => "nullable|array",
    ];
}
