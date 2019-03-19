<?php 
namespace MacsiDigital\Zoom\Classes;

class Webinar extends Model
{

    protected $attributes = [
        "uuid" => '', // string
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
            "panelists_video" => '', // boolean
            "practice_session" => '', // boolean
            "hd_video" => '', // boolean
            "approval_type" => '', // integer
            "registration_type" => '', // integer
            "audio" => '', // string
            "auto_recording" => '', // string
            "enforce_login" => '', // boolean
            "enforce_login_domains" => '', // string
            "alternative_hosts" => '', // string
            "close_registration" => '', // boolean
            "show_share_button" => '', // boolean
            "allow_multiple_devices" => '', // boolean
            "registrants_confirmation_email" => '', // boolean
        ],
    ];


            


}