<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingParticipant extends Model
{
    //protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreRegistrant';

    protected $endPoint = '/metrics/meetings/{meeting:id}/participants';

    protected $allowedMethods = ['get', 'post', 'put'];

    protected $apiMultipleDataField = 'participants';

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }
}
