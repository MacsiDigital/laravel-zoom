<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Permission extends Model
{
    protected $endPoint = 'users/{user_id}/permissions';

    protected $allowedMethods = ['get'];

    protected $apiMultipleDataField = 'permissions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
