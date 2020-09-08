<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Account extends Model
{
    // API included but its not open to the majority of API Users
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreAccount';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateAccount';
    
    protected $endPoint = 'accounts';

    protected $allowedMethods = ['get', 'post', 'delete'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'accounts';
}
