<?php

namespace MacsiDigital\Zoom\Enums\Webinar;

use BenSampo\Enum\Enum;

final class WebinarType extends Enum
{
    const TYPE_WEBINAR = 5;
    const TYPE_RECURRING_WEBINAR_WITHOUT_FIXED_TIME = 6;
    const TYPE_RECURRING_WEBINAR_WITH_FIXED_TIME = 9;
}
