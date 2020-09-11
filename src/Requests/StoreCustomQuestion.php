<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreCustomQuestion extends PersistResource
{
    protected $persistAttributes = [
        'title' => 'required|string',
        'value' => 'required|string',
    ];
}
