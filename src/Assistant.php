<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Assistant extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreAssistant';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateAssistant';
    
    protected $endPoint = 'users/{user_id}/assistants';

    protected $allowedMethods = ['get', 'post', 'delete'];

    protected $apiMultipleDataField = 'assistants';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }
}
