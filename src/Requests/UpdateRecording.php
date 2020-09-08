<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateRecording extends PersistResource
{
    protected $persistAttributes = [
        "local_recording" => "nullable|boolean",
        "cloud_recording" => "nullable|boolean",
        "record_speaker_view" => "nullable|boolean",
        "record_gallery_view" => "nullable|boolean",
        "record_audio_file" => "nullable|boolean",
        "save_chat_text" => "nullable|boolean",
        "show_timestamp" => "nullable|boolean",
        "recording_audio_transcript" => "nullable|boolean",
        "auto_recording" => "nullable|in:none,local,cloud",
        "auto_delete_cmr" => "nullable|boolean",
        "host_pause_stop_recording" => "nullable|boolean",
        "auto_delete_cmr_days" => "nullable|numeric|between:1,60",
    ];

    protected $relatedResource = [
        "recording_password_requirement" => UpdateRecordingPasswordRequirement::class,
    ];
}
