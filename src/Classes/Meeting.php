<?php 
namespace MacsiDigital\Zoom\Classes;

class Meeting extends Model
{

	protected $attributes = [
        'uuid' => '',
        "id" => '', // string
        "host_id" => '', // string
        "created_at" => '', // string [date-time]
        "join_url" => '', // string
        "topic" => '', // string
        "type" => '', // integer
        "start_time" => '', // string [date-time]
        "duration" => '', // integer
        "timezone" => '', // string
        "password" => '', // string
        "agenda" => '', // string
        "recurrence" => [],
        "occurrences" => [],
        "settings" => [
            "host_video" => '', // boolean
            "participant_video" => '', // boolean
            "cn_meeting" => '', // boolean
            "in_meeting" => '', // boolean
            "join_before_host" => '', // boolean
            "mute_upon_entry" => '', // boolean
            "watermark" => '', // boolean
            "use_pmi" => '', // boolean
            "approval_type" => '', // integer
            "registration_type" => '', // integer
            "audio" => '', // string
            "auto_recording" => '', // string
            "enforce_login" => '', // boolean
            "enforce_login_domains" => '', // string
            "alternative_hosts" => '', // strin
        ],
    ];

}