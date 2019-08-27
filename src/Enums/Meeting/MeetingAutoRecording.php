<?php

namespace MacsiDigital\Zoom\Enums\Meeting;

use BenSampo\Enum\Enum;

final class MeetingAutoRecording extends Enum
{
    const RECORDING_CLOUD = 'cloud';
    const RECORDING_LOCAL = 'local';
    const RECORDING_NONE = 'none';
}
