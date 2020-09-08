<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Participant extends Model
{
    protected $endPoint = '/past_webinars/{webinar:uuid}/participants';

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = 'participants';
}
