<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateTsp extends PersistResource
{
    protected $persistAttributes = [
        "call_out" => "nullable|boolean",
        "call_out_countries" => "nullable|array",
        "show_international_numbers_link" => "nullable|boolean",
    ];
}
