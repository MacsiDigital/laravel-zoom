<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreRegistrant extends PersistResource
{
    protected $persistAttributes = [
      "email" => "required|email",
      "first_name" => "required|string|max:64",
      "last_name" => "nullable|string|max:64",
      "address" => "nullable|string|max:64",
      "city" => "nullable|string|max:64",
      "country" => "nullable|string|max:64",
      "zip" => "nullable|string|max:20",
      "state" => "nullable|string|max:64",
      "phone" => "nullable|string|max:64",
      "industry" => "nullable|string|max:64",
      "org" => "nullable|string|max:64",
      "job_title" => "nullable|string|max:64",
      "purchasing_time_frame" => "nullable|string|in:Within a month,1-3 Months,4-6 Months,More than 6 months,More timeframe",
      "role_in_purchase_process" => "nullable|string|in:Decision Maker,Evaluator/Recommender,Influencer,Not involved",
      "no_of_employees" => "nullable|string|in:1-20,21-50,51-100,101-500,501-1,000,1,001-5,000,5,001-10,000,More than 10,000",
      "comments" => 'nullable|string|max:2000',
      "auto_approve" => 'nullable'
    ];

    protected $relatedResource = [
        "custom_questions" => StoreCustomQuestion::class,
    ];
}
