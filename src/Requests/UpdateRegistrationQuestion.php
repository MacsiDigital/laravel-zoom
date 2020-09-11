<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateRegistrationQuestion extends PersistResource
{
    protected $relatedResource = [
        "questions" => UpdateQuestion::class,
        "custom_questions" => UpdateCustomQuestion::class,
    ];
}
