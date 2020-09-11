<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateIntegration extends PersistResource
{
    protected $persistAttributes = [
        "linkedin_sales_navigator" => "nullable|boolean",
    ];
}
