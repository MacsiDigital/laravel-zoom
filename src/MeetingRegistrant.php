<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingRegistrant extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StoreRegistrant';

    protected $endPoint = 'meetings/{meeting:id}/registrants';

    protected $allowedMethods = ['get', 'post', 'put', 'find', 'delete'];

    protected $apiMultipleDataField = 'registrants';

    public function getApiMultipleDataField()
    {
        return $this->apiMultipleDataField;
    }

    public function customQuestions()
    {
        return $this->hasMany(CustomQuestion::class);
    }

    public function beforeQuery($query)
    {
        if (isset($this->occurrence_id)) {
            $query->addQuery('occurrence_id', $this->occurrence_id);
        }
    }

    public function beforeInsert($query)
    {
        if (isset($this->occurrence_id)) {
            $query->addQuery('occurrence_id', $this->occurrence_id);
        }
    }

    protected function updateAction($action)
    {
        if ($this->exists()) {
            if (isset($this->occurrence_id)) {
                return $this->newQuery()->sendRequest('put', ['meetings/'.$this->meeting_id.'/registrants/status', ['action' => $action, 'registrants' => [['id' => $this->id, 'email' => $this->email]]], ['occurrence_id' => $this->occurrence_id]])->successful();
            } else {
                return $this->newQuery()->sendRequest('put', ['meetings/'.$this->meeting_id.'/registrants/status', ['action' => $action, 'registrants' => [['id' => $this->id, 'email' => $this->email]]]])->successful();
            }
        }
    }

    public function approve()
    {
        return $this->updateAction('approve');
    }

    public function deny()
    {
        return $this->updateAction('deny');
    }

    public function cancel()
    {
        return $this->updateAction('cancel');
    }
}
