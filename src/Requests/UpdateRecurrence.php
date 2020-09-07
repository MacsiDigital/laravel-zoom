<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateRecurrence extends PersistResource
{

    protected $persistAttributes = [
    	"type" => "nullable|integer|in:1,2,3",
	    "repeat_interval" => "nullable|integer",
	    "weekly_days" => "nullable|string",
	    "monthly_day" => "nullable|numeric|between:1,31",
	    "monthly_week" => "nullable|numeric|in:-1,1,2,3,4",
	    "monthly_week_day" => "nullable|integer|in:1,2,3,4,5,6,7",
	    "end_times" => "nullable|numeric|max:50",
	    "end_date_time" => "nullable|date"
    ];

}
