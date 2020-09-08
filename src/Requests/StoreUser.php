<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreUser extends PersistResource
{
    protected $persistAttributes = [
        'action' => 'required|in:create,autoCreate,custCreate,ssoCreate',
        'user_info.email' => 'required|email|max:128',
        'user_info.type' => 'required|in:1,2,3',
        'user_info.first_name' => 'nullable|string|max:64',
        'user_info.last_name' => 'nullable|string|max:64',
        'user_info.password' => 'nullable|between:8,32',
    ];

    protected $mutateAttributes = [
        'email' => 'user_info.email',
        'type' => 'user_info.type',
        'first_name' => 'user_info.first_name',
        'last_name' => 'user_info.last_name',
        'password' => 'user_info.password',
    ];
}
