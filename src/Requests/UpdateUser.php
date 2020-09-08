<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateUser extends PersistResource
{
    protected $persistAttributes = [
        'first_name' => 'nullable|string|max:64',
        'last_name' => 'nullable|string|max:64',
        'type' => 'nullable|in:1,2,3',
        'pmi' => 'nullable|size:10',
        'use_pmi' => 'nullable|boolean',
        'timezone' => '',
        'language' => '',
        'dept' => '',
        'vanity_name' => '',
        'host_key' => 'nullable|between:6,10',
        'cms_user_id' => '',
        'job_title' => 'nullable|max:128',
        'company' => 'nullable|max:255',
        'location' => 'nullable|max:256',
        'phone_number' => '',
        'phone_country' => '',
    ];
}
