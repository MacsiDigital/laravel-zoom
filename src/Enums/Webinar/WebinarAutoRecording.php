<?php

namespace MacsiDigital\Zoom\Enums\Webinar;

use BenSampo\Enum\Enum;

final class WebinarAutoRecording extends Enum
{
    const RECORDING_CLOUD = 'cloud';
    const RECORDING_LOCAL = 'local';
    const RECORDING_NONE = 'none';
}
