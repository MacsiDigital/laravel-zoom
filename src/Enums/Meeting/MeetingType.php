<?php

namespace MacsiDigital\Zoom\Enums\Meeting;

use BenSampo\Enum\Enum;

final class MeetingType extends Enum
{
    const TYPE_INSTANT = 1;
    const TYPE_SCHEDULED = 2;
    const TYPE_RECURRING_WITHOUT_FIXED_TIME = 3;
    const TYPE_RECURRING_WITH_FIXED_TIME = 8;
}
