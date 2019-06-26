<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class WebinarSetting extends Model
{
    public $response;

    const KEY_FIELD = 'host_video';

    protected $attributes = [
        'host_video' => '', // boolean
        'panelists_video' => '', // boolean
        'practice_session' => '', // boolean
        'hd_video' => '', // boolean
        'approval_type' => '', // integer
        'registration_type' => '', // integer
        'audio' => '', // string
        'auto_recording' => '', // string
        'enforce_login' => '', // boolean
        'enforce_login_domains' => '', // string
        'alternative_hosts' => '', // string
        'close_registration' => '', // boolean
        'show_share_button' => '', // boolean
        'allow_multiple_devices' => '', // boolean
        'on_demand' => '', // boolean
        'global_dial_in_countries' => '', // string
        'contact_name' => '', // boolean
        'contact_email' => '', // boolean
        'registrants_confirmation_email' => '', //boolean
    ];

    protected $createAttributes = [
        'host_video',
        'panelists_video',
        'practice_session',
        'hd_video',
        'approval_type',
        'registration_type',
        'audio',
        'auto_recording',
        'enforce_login',
        'enforce_login_domains',
        'alternative_hosts',
        'close_registration',
        'show_share_button',
        'allow_multiple_devices',
        'on_demand',
        'global_dial_in_countries',
        'contact_name',
        'contact_email',
    ];

    protected $updateAttributes = [
        'host_video',
        'panelists_video',
        'practice_session',
        'hd_video',
        'approval_type',
        'registration_type',
        'audio',
        'auto_recording',
        'enforce_login',
        'enforce_login_domains',
        'alternative_hosts',
        'close_registration',
        'show_share_button',
        'allow_multiple_devices',
        'on_demand',
        'global_dial_in_countries',
        'contact_name',
        'contact_email',
        'registrants_confirmation_email',
    ];
}
