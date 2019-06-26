<?php

namespace MacsiDigital\Zoom\Interfaces;

use MacsiDigital\Zoom\Support\Request;

class PrivateApplication extends Base
{
    protected $request;

    public function __construct()
    {
        $this->request = (new Request)->bootPrivateApplication();
    }
}
