<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Scheduler extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreScheduler';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateScheduler';
    
    protected $endPoint = 'users/{user_id}/schedulers';

    protected $allowedMethods = ['get', 'delete'];

    protected $apiMultipleDataField = 'schedulers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }
}
