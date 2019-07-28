<?php

namespace MacsiDigital\Zoom;

use Exception;
use MacsiDigital\Zoom\Support\Model;

class Webinar extends Model
{
    const ENDPOINT = 'webinars';
    const NODE_NAME = 'webinar';
    const KEY_FIELD = 'id';

    protected $methods = ['get', 'post', 'patch', 'put', 'delete'];

    protected $userID;

    protected $attributes = [
        'uuid' => '', // string
        'id' => '', // string
        'host_id' => '', // string
        'created_at' => '', // string [date-time]
        'join_url' => '', // string
        'topic' => '', // string
        'type' => '', // integer
        'start_time' => '', // string [date-time]
        'duration' => '', // integer
        'timezone' => '', // string
        'password' => '', // string
        'agenda' => '', // string
        'recurrence' => [],
        'occurrences' => [],
        'settings' => [],
    ];

    protected $createAttributes = [
        'topic',
        'type',
        'start_time',
        'duration',
        'timezone',
        'password',
        'agenda',
        'recurrence',
        'settings',
    ];

    protected $updateAttributes = [
        'topic',
        'type',
        'start_time',
        'duration',
        'timezone',
        'password',
        'agenda',
        'recurrence',
        'settings',
    ];

    protected $relationships = [
        'settings' => '\MacsiDigital\Zoom\WebinarSetting',
        'recurrance' => '\MacsiDigital\Zoom\Recurrance',
        'occurances' => '\MacsiDigital\Zoom\Occurance',
        'tracking_fields' => '\MacsiDigital\Zoom\TrackingFields',
    ];

    public function addTrackingField(TrackingField $tracking_field)
    {
        $this->attributes['tracking_fields'][] = $tracking_field;

        return $this;
    }

    public function addRecurrance(Recurrance $recurance)
    {
        $this->attributes['recurrance'] = $recurance;

        return $this;
    }

    public function addSettings(MeetingSetting $settings)
    {
        $this->attributes['settings'] = $settings;

        return $this;
    }

    public function addOccurence(Occurance $occurance)
    {
        $this->attributes['occurances'][] = $occurance;

        return $this;
    }

    public function setUserID($user_id)
    {
        $this->userID = $user_id;

        return $this;
    }

    public function make($attributes)
    {
        $model = new static;
        $model->fill($attributes);
        if (isset($this->userID)) {
            $model->setUserID($this->userID);
        }

        return $model;
    }

    public function get()
    {
        if ($this->userID != '') {
            if (in_array('get', $this->methods)) {
                $this->response = $this->client->get("users/{$this->userID}/".$this->getEndPoint().$this->getQueryString());
                if ($this->response->getStatusCode() == '200') {
                    return $this->collect($this->response->getBody());
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        } else {
            throw new Exception('No User to retreive Meetings');
        }
    }

    public function all()
    {
        if ($this->userID != '') {
            if (in_array('get', $this->methods)) {
                $this->response = $this->client->get("users/{$this->userID}/".$this->getEndPoint());
                if ($this->response->getStatusCode() == '200') {
                    return $this->collect($this->response->getBody());
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        } else {
            throw new Exception('No User to retreive Meetings');
        }
    }

    public function save()
    {
        if ($this->hasID()) {
            if (in_array('put', $this->methods) || in_array('patch', $this->methods)) {
                $this->response = $this->client->patch("{$this->getEndpoint()}/{$this->getID()}", $this->updateAttributes());
                if ($this->response->getStatusCode() == '204') {
                    return $this;
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        } else {
            if (in_array('post', $this->methods)) {
                $this->response = $this->client->post("users/{$this->userID}/{$this->getEndPoint()}", $this->createAttributes());
                if ($this->response->getStatusCode() == '201') {
                    $this->fill($this->response->getBody());

                    return $this;
                } else {
                    throw new Exception($this->response->getStatusCode().' status code');
                }
            }
        }
    }

    public function registrants()
    {
        $registrant = new \MacsiDigital\Zoom\Registrant;
        $registrant->setType('webinars');
        $registrant->setRelationshipID($this->getID());

        return $registrant;
    }

    public function panelists()
    {
        $panelist = new \MacsiDigital\Zoom\Panelist;
        $panelist->setWebinarID($this->getID());

        return $panelist;
    }

    public function cancelRegistrant($registrant)
    {
        $this->response = $this->client->put("/webinars/{$this->getID()}/registrants/status", ['action' => 'cancel', 'registrant' => [['email' => $registrant->email]]]);
        if ($this->response->getStatusCode() == '204') {
            return $this->response->getBody();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }

    public function denyRegistrant($registrant)
    {
        $this->response = $this->client->put("/webinars/{$this->getID()}/registrants/status", ['action' => 'deny', 'registrant' => [['email' => $registrant->email]]]);
        if ($this->response->getStatusCode() == '204') {
            return $this->response->getBody();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }

    public function approveRegistrant($registrant)
    {
        $this->response = $this->client->put("/webinars/{$this->getID()}/registrants/status", ['action' => 'approve', 'registrant' => [['email' => $registrant->email]]]);
        if ($this->response->getStatusCode() == '204') {
            return $this->response->getBody();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }

    public function deletePanelist($panelist)
    {
        $this->response = $this->client->delete("/webinars/{$this->getID()}/panelists/{$panelist->id}");
        if ($this->response->getStatusCode() == '204') {
            return $this->response->getBody();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }

    public function deletePanelists()
    {
        $this->response = $this->client->delete("/webinars/{$this->getID()}/panelists");
        if ($this->response->getStatusCode() == '204') {
            return $this->response->getBody();
        } else {
            throw new Exception($this->response->getStatusCode().' status code');
        }
    }
}
