<?php

namespace MacsiDigital\Zoom;

use Exception;
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

    public function save()
    {
        if ($this->hasID()) {
            if (in_array('put', $this->methods)) {
                $this->response = $this->client->patch("{$this->getEndpoint()}/{$this->getID()}", $this->updateAttributes);
                if ($this->response->getStatusCode() == '200') {
                    return $this;
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        } else {
            if (in_array('post', $this->methods)) {
                $attributes = ['action' => 'create', 'user_info' => $this->createAttributes];
                $this->response = $this->client->post($this->getEndpoint(), $attributes);
                if ($this->response->getStatusCode() == '200') {
                    $this->fill($this->response->getBody());

                    return $this;
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        }
    }

    public function meetings()
    {
        $meeting = new \MacsiDigital\Zoom\Meeting;
        $meeting->setUserID($this->getID());

        return $meeting;
    }

    public function webinars()
    {
        $webinar = new \MacsiDigital\Zoom\Webinar;
        $webinar->setUserID($this->getID());

        return $webinar;
    }
}
