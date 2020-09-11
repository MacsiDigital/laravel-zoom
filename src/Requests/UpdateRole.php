<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateRole extends PersistResource
{
    protected $persistAttributes = [
        'name' => 'nullable|string|max:128',
        'description' => 'nullable|string|max:128',
        'privileges' => 'nullable|array',
    ];
}
