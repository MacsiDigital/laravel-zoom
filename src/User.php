<?php

namespace MacsiDigital\Zoom;

use Exception;
use MacsiDigital\Zoom\Enums\User\CreateUserAction;
use MacsiDigital\Zoom\Support\Model;

class User extends Model
{
    const ENDPOINT = 'users';
    const NODE_NAME = 'user';
    const KEY_FIELD = 'id';

    protected $methods = ['get', 'post', 'patch', 'put', 'delete'];

    protected $attributes = [
        'first_name' => '', //string
        'last_name' => '', //string
        'email' => '', //string
        'type' => '', //integer
        'pmi' => '', //string
        'use_pmi' => '',
        'timezone' => '', //string
        'dept' => '', //string
        'created_at' => '', //string [date-time]
        'last_login_time' => '', //string [date-time]
        'last_client_version' => '', //string
        'language' => '',
        'phone_country' => '',
        'phone_number' => '',
        'vanity_url' => '', // string
        'personal_meeting_url' => '', // string
        'verified' => '', // integer
        'pic_url' => '', // string
        'cms_user_id' => '', // string
        'account_id' => '', // string
        'host_key' => '', // string
        'status' => '',
        'group_ids' => [],
        'im_group_ids' => [],
        'password' => '',
        'id' => '',
        'jid' => '',
    ];

    protected $createAttributes = [
        'first_name',
        'last_name',
        'email',
        'type',
        'password',
    ];

    protected $updateAttributes = [
        'first_name',
        'last_name',
        'type',
        'pmi',
        'use_pmi',
        'timezone',
        'dept',
        'language',
        'dept',
        'vanity_name',
        'host_key',
        'cms_user_id',
    ];

    protected $createAction = '';

    protected function setCreateAction($action)
    {
        if (!in_array($action, CreateUserAction::getValues())) {
            throw new Exception('Invalid action');
        }

        $this->createAction = $action;
    }

    public function make($attributes, $action = CreateUserAction::ACTION_CREATE)
    {
        if (!$this->createAction) {
            $this->setCreateAction($action);
        }

        foreach ($attributes as $attribute => $value) {
            $this->$attribute = $value;
        }

        return $this;
    }

    public function create($attributes, $action = CreateUserAction::ACTION_CREATE)
    {
        $this->setCreateAction($action);

        return parent::create($attributes);
    }

    public function save()
    {
        $index = $this->GetKey();
        if ($this->hasID()) {
            if (in_array('put', $this->methods)) {
                $this->response = $this->client->patch("{$this->getEndpoint()}/{$this->id}", $this->updateAttributes());
                if ($this->response->getStatusCode() == '204') {
                    return $this->response->getContents();
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        } else {
            if (in_array('post', $this->methods)) {
                $attributes = ['action' => $this->createAction, 'user_info' => $this->createAttributes()];
                $this->response = $this->client->post($this->getEndpoint(), $attributes);
                if ($this->response->getStatusCode() == '201') {
                    $saved_item = $this->collect($this->response->getContents())->first();
                    $this->$index = $saved_item->$index;

                    return $this->response->getContents();
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        }
    }

    public function meetings()
    {
        $meeting = new \MacsiDigital\Zoom\Meeting;
        $meeting->setUserID($this->id);

        return $meeting;
    }

    public function webinars()
    {
        $webinar = new \MacsiDigital\Zoom\Webinar;
        $webinar->setUserID($this->id);

        return $webinar;
    }
}
