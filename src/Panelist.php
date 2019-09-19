<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Panelist extends Model
{
    public $webinar_id;

    const KEY_FIELD = 'id';

    protected $attributes = [
        'id' => '', // string
        'name' => '', // string
        'email' => '', // string
        'join_url' => '', // string
    ];

    protected $createAttributes = [
        'id',
        'name',
        'email',
        'join_url',
    ];

    protected $updateAttributes = [
        'id',
        'name',
        'email',
        'join_url',
    ];

    public function setWebinarID($webinar_id)
    {
        $this->webinarID = $webinar_id;
    }

    public function make($attributes)
    {
        $model = new static;
        $model->fill($attributes);
        if (isset($this->webinarID)) {
            $model->setwebinarID($this->webinarID);
        }

        return $model;
    }
}
