<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Role extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreRole';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateRole';
    
    protected $endPoint = 'roles';

    protected $allowedMethods = ['find', 'get', 'post', 'patch', 'delete'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'roles';

    public function members()
    {
        return $this->hasMany(User::class, 'members');
    }

    public function giveRoleTo($user)
    {
    }

    public function removeRoleFrom($user)
    {
    }
}
