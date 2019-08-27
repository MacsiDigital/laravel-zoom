<?php

namespace MacsiDigital\Zoom\Enums\Meeting;

use BenSampo\Enum\Enum;

final class MeetingRegistrationType extends Enum
{
    const REGISTER_ONCE = 1;
    const REGISTER_EACH_TIME = 2;
    const REGISTER_ONCE_WITH_CHOICE = 3;
}
