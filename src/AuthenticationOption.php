<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class AuthenticationOption extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreAuthenticationOption';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateAuthenticationOption';
}
