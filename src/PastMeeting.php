<?php

namespace MacsiDigital\Zoom;

use Exception;
use MacsiDigital\Zoom\Support\Model;

class PastMeeting extends Model
{
    const ENDPOINT = 'past_meetings';
    const NODE_NAME = 'past_meeting';
    const KEY_FIELD = 'id';

    protected $methods = ['get', 'post', 'patch', 'put', 'delete'];

    protected $userID;

    public $response;

    protected $attributes = [
        'uuid' => '',
        'id' => '', // string
        'host_id' => '', // string
        'type' => '', // integer
        'topic' => '', // string
        'user_name' => '', // string
        'user_email' => '', // string
        'start_time' => '', // string [date-time]
        'end_time' => '', // string [date-time]
        'duration' => '', // integer
        'total_minutes' => '', // integer
        'participants_count' => '', // integer
    ];

    public function find($uuid)
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint() . '/' . $uuid);
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getContents())->first();
            } else {
                throw new Exception($this->response->getStatusCode().' status code');
            }
        }
    }

    public function participants()
    {
        $this->response = $this->client->get($this->getEndpoint() . '/' . $this->uuid . '/' . 'participants');
        if ($this->response->getStatusCode() == '200') {
            return $this->response->getContents();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }
}
