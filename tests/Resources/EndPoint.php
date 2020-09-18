<?php

namespace MacsiDigital\Zoom\Tests\Resources;

class EndPoint
{
    protected $apiKey = '';
    protected $apiSecret = '';

    protected $endPoints = [
        'methods' => [
            'find' => [

            ],
            'get' => [

            ],
            'post' => [

            ],
            'put' => [

            ],
            'patch' => [

            ],
            'delete' => [

            ],
        ],
    ];

    public function authenticate($token)
    {
    }

    public function processEndPoint($method, $endPoint)
    {
        if ($this->hasEndPoint($method, $endPoint)) {
            $this->retreiveData($method, $endPoint);
        }
    }

    public function hasEndPoint()
    {
        if (isset($this->endPoints[$method]) && isset($this->endPoints[$method][$endPoint])) {
            return true;
        }

        return false;
    }

    public function retreieveData($method, $endPoint)
    {
        $function = $this->endPoints[$method][$endPoint];

        return $this->$function();
    }
}
