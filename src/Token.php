<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Token extends Model
{
    protected $endPoint = 'users/{user_id}/token';

    protected $allowedMethods = ['get', 'delete'];

    protected $apiMultipleDataField = 'token';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
