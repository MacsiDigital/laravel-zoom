<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingSetting extends Model
{
    public $response;

    const KEY_FIELD = 'host_video';

    protected $attributes = [
        'host_video' => '', // boolean
        'participant_video' => '', // boolean
        'cn_meeting' => '', // boolean
        'in_meeting' => '', // boolean
        'join_before_host' => '', // boolean
        'mute_upon_entry' => '', // boolean
        'watermark' => '', // boolean
        'use_pmi' => '', // boolean
        'approval_type' => '', // integer
        'registration_type' => '', // integer
        'audio' => '', // string
        'auto_recording' => '', // string
        'enforce_login' => '', // boolean
        'enforce_login_domains' => '', // string
        'alternative_hosts' => '', // string
        'close_registration' => '', // string
        'waiting_room' => '', // string
        'contact_name' => '', // string
        'contact_email' => '', // string
        'registrants_confirmation_email' => '', // boolean
        'global_dial_in_countries' => '',
        'global_dial_in_numbers' => [],
    ];

    protected $createAttributes = [
        'host_video',
        'participant_video',
        'cn_meeting',
        'in_meeting',
        'join_before_host',
        'mute_upon_entry',
        'watermark',
        'use_pmi',
        'approval_type',
        'registration_type',
        'audio',
        'auto_recording',
        'enforce_login',
        'enforce_login_domains',
        'alternative_hosts',
        'close_registration',
        'waiting_room',
        'contact_name',
        'contact_email',
    ];

    protected $updateAttributes = [
        'host_video',
        'participant_video',
        'cn_meeting',
        'in_meeting',
        'join_before_host',
        'mute_upon_entry',
        'watermark',
        'use_pmi',
        'approval_type',
        'registration_type',
        'audio',
        'auto_recording',
        'enforce_login',
        'enforce_login_domains',
        'alternative_hosts',
        'close_registration',
        'waiting_room',
        'contact_name',
        'contact_email',
        'registrants_confirmation_email',
    ];

    protected $relationships = [
        'global_dial_in_numbers' => '\MacsiDigital\Zoom\GlobalDialInNumber',
    ];

    public function addGlobalDialInNumbers(GlobalDialInNumber $number)
    {
        $this->global_dial_in_numbers[] = $number;
    }
}
