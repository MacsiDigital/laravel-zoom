<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class CustomQuestion extends Model
{
    const KEY_FIELD = 'title';

    protected $methods = [];

    protected $attributes = [
        'title' => '', // string
        'value' => '', // string
    ];

    protected $createAttributes = [
        'title',
        'value',
    ];

    protected $updateAttributes = [
        'title',
        'value',
    ];
}
