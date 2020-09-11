<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Poll extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StorePoll';
    protected $storeResource = 'MacsiDigital\Zoom\Requests\UpdatePoll';

    protected $endPoint = '/meetings/{meeting:id}/polls';

    protected $allowedMethods = ['find', 'get', 'post', 'put', 'delete'];

    protected $apiMultipleDataField = 'polls';

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }

    public function questions()
    {
        return $this->hasMany(PollQuestion::class);
    }
}
