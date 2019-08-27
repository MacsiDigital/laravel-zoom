<?php

namespace MacsiDigital\Zoom\Enums\Webinar;

use BenSampo\Enum\Enum;

final class WebinarRegistrationType extends Enum
{
    const REGISTER_ONCE = 1;
    const REGISTER_EACH_SESSION = 2;
    const REGISTER_ONCE_WITH_CHOICE = 3;
}
