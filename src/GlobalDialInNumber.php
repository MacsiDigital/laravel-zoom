<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class GlobalDialInNumber extends Model
{
    public $response;

    const KEY_FIELD = 'country';

    protected $attributes = [
        'country' => '', // boolean
        'country_name' => '', // boolean
        'city' => '', // boolean
        'number' => '', // boolean
        'type' => '', // boolean
    ];

    protected $createAttributes = [

    ];

    protected $updateAttributes = [
        'country',
        'country_name',
        'city',
        'number',
        'type',
    ];
}
