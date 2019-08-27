<?php

namespace MacsiDigital\Zoom\Enums\Webinar;

use BenSampo\Enum\Enum;

final class WebinarApprovalType extends Enum
{
    const TYPE_AUTOMATIC = 0;
    const TYPE_MANUAL = 1;
    const TYPE_NO_REGISTRATION = 2;
}
