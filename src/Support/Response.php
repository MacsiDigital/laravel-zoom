<?php

namespace MacsiDigital\Zoom\Support;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    protected $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getBody()
    {
        return json_decode($this->response->getBody(), true);
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}
