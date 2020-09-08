<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class LiveStream extends Model
{
    protected $endPoint = 'meetings/{meeting:id}/livestream';

    protected $allowedMethods = ['put'];

    protected $apiMultipleDataField = '';
}
