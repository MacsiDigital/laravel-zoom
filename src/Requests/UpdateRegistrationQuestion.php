<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateRegistrantQuestion extends PersistResource
{

    protected $relatedResource = [
    	"questions" => UpdateQuestion::class,
    	"custom_questions" => UpdateCustomQuestion::class
    ];
    
}