<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Instance extends Model
{
    protected $endPoint = '/past_webinars/{webinar:uuid}/instances';

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = 'instances';
}
