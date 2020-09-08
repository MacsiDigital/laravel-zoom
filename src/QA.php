<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\API\Support\Resource;

class QA extends Resource
{
    protected $endPoint = '/past_meetings/{meeting:uuid}/qa';

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = '';
}
