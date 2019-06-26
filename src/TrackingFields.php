<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class TrackingFields extends Model
{
    public $response;

    const KEY_FIELD = 'field';

    protected $attributes = [
        'field' => '', // boolean
        'value' => '', // boolean
    ];

    protected $createAttributes = [
        'field',
        'value',
    ];

    protected $updateAttributes = [
        'field',
        'value',
    ];
}
