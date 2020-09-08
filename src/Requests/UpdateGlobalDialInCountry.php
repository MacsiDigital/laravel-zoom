<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateGlobalDialInCountry extends PersistResource
{
    protected $persistAttributes = [
        "city" => "nullable|string",
        "country" => "nullable|string",
        "country_name" => "nullable|string",
        "number" => "nullable|string",
        "type" => "nullable|in:toll,tollfree",
    ];
}
