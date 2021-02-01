<?php

namespace MacsiDigital\Zoom;

use Illuminate\Support\Facades\Validator;
use MacsiDigital\Zoom\Exceptions\FileTooLargeException;
use MacsiDigital\Zoom\Exceptions\ValidationException;
use MacsiDigital\Zoom\Support\Model;

class User extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreUser';
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateUser';

    protected $attributes = [
        'action' => 'create',
        'type' => 1,
    ];

    protected $endPoint = 'users';

    protected $allowedMethods = ['find', 'get', 'post', 'patch', 'delete'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'users';

    public function isBasicType()
    {
        $this->type = 1;

        return $this;
    }

    public function isLicensedType()
    {
        $this->type = 2;

        return $this;
    }

    public function isOnPremType()
    {
        $this->type = 3;

        return $this;
    }

    public function assistants()
    {
        return $this->hasMany(Assistant::class);
    }

    public function schedulers()
    {
        return $this->hasMany(Scheduler::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }

    public function webinars()
    {
        return $this->hasMany(Webinar::class);
    }

    public function setBasic()
    {
        $this->type = '1';
    }

    public function setLicensed()
    {
        $this->type = '2';
    }

    public function setOnPrem()
    {
        $this->type = '3';
    }

    public function updateProfilePicture($image)
    {
        $filesize = number_format(filesize($image) / 1048576, 2);
        if ($filesize > 2) {
            throw new FileTooLargeException($image, $filesize, '2MB');
        } else {
            return $this->newQuery()->attachFile('pic_file', file_get_contents($image), $image)->sendRequest('post', ['users/'.$this->id.'/picture'])->successful();
        }
    }

    public function updateStatus($status)
    {
        if (in_array($status, ['activate', 'deactivate'])) {
            return $this->newQuery()->sendRequest('put', ['users/'.$this->id.'/status', ['action' => $status]])->successful();
        } else {
            throw new ValidationException('Status must be either active or deactivate');
        }
    }

    public function updatePassword($password)
    {
        if (strlen($password) >= 8) {
            return $this->newQuery()->sendRequest('put', ['users/'.$this->id.'/password', ['password' => $password]])->successful();
        } else {
            throw new ValidationException('Password must be at least 8 characters');
        }
    }

    public function updateEmail($email)
    {
        $validator = Validator::make(['email' => $email], [ 'email' => 'required|email|max:128' ]);
        if ($validator->fails()) {
            throw new ValidationException('Email must be a valid email address less than 128 characters');
        } else {
            return $this->newQuery()->sendRequest('put', ['users/'.$this->id.'/email', ['email' => $email]])->successful();
        }
    }

    public function disassociate()
    {
        return $this->newQuery()->sendRequest('delete', ['users/'.$this->id, ['action' => 'disassociate']])->successful();
    }

    public function delete()
    {
        return $this->newQuery()->sendRequest('delete', ['users/'.$this->id, ['action' => 'delete']])->successful();
    }
}
