<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class PollResult extends Resource
{
    protected $endPoint = '/past_webinars/{webinar:uuid}/polls';

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = '';
}
