<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreEmailNotification extends PersistResource
{
    protected $persistAttributes = [
        "enable" => "nullable|boolean",
        "type" => "nullable|integer|in:0,1,2,3,4,5,6,7"
    ];
}
