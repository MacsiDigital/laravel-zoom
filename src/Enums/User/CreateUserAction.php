<?php

namespace MacsiDigital\Zoom\Enums\User;

use BenSampo\Enum\Enum;

final class CreateUserAction extends Enum
{
    const ACTION_CREATE = 'create';
    const ACTION_AUTO_CREATE = 'autoCreate';
    const ACTION_CUST_CREATE = 'custCreate';
    const ACTION_SSO_CREATE = 'ssoCreate';
}
