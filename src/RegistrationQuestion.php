<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class RegistrationQuestion extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\UpdateRegistrantQuestion';
    
    protected $endPoint = 'meetings/{meeting:id}/registrants/questions';

    protected $allowedMethods = ['get', 'put'];

    protected $apiMultipleDataField = '';

}
