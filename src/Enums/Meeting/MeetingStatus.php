<?php

namespace MacsiDigital\Zoom\Enums\Meeting;

use BenSampo\Enum\Enum;

final class MeetingStatus extends Enum
{
    const STATUS_WAITING = 'waiting';
    const STATUS_STARTED = 'started';
    const STATUS_FINISHED = 'finished';
}
