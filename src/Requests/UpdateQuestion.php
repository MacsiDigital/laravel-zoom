<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateQuestion extends PersistResource
{
    protected $persistAttributes = [
        "field_name" => "nullable|string|in:address,city,country,zip,state,phone,industry,org,job_title,purchasing_time_frame,role_in_purchase_process,no_of_employees,comments",
        "required" => "nullable|boolean",
    ];
}
