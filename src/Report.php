<?php

namespace MacsiDigital\Zoom;

use Exception;
use MacsiDigital\Zoom\Support\Model;

class Report extends Model
{
    const ENDPOINT = 'report';
    const NODE_NAME = 'report';
    const KEY_FIELD = 'id';

    protected $methods = ['get', 'post', 'patch', 'put', 'delete'];

    protected $userID;

    public $response;

    public function meetingParticipantReport($meetingId)
    {
        $this->response = $this->client->get(static::getEndpoint() . "/meetings/{$meetingId}/participants");
        if ($this->response->getStatusCode() == '200') {
            return $this->response->getContents();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }
}
