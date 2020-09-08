<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class LiveStreamStatus extends Model
{
    protected $endPoint = 'meetings/{meeting:id}/livestream/status';

    protected $allowedMethods = ['patch'];

    protected $apiMultipleDataField = '';

    public function settings()
    {
        return $this->hasOne(LiveStreamStatusSetting::class);
    }
}
