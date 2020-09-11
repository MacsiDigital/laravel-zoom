<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreRegistrantCustomQuestion extends PersistResource
{
    protected $persistAttributes = [
        "title" => "nullable|string",
        "value" => "nullable|string",
    ];
}
