<?php

namespace MacsiDigital\Zoom\Enums\Meeting;

use BenSampo\Enum\Enum;

final class MeetingApprovalType extends Enum
{
    const TYPE_AUTOMATIC = 0;
    const TYPE_MANUAL = 1;
    const TYPE_NO_REGISTRATION = 2;
}
