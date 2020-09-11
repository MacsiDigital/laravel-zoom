<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateCustomQuestion extends PersistResource
{
    protected $persistAttributes = [
        "title" => "nullable|string",
        "type" => "nullable|string|in:short,single",
        'required' => 'nullable|boolean',
        'answers' => 'nullable|array',
    ];
}
