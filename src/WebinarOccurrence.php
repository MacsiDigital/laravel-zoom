<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class WebinarOccurrence extends Model
{
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateOccurrence';

    protected $endPoint = 'webinars/{webinar:id}';

    protected $allowedMethods = ['find', 'get', 'patch', 'delete'];

    protected $apiDataField = '';

    protected $primaryKey = 'occurrence_id';

    protected $apiMultipleDataField = 'occurrences';

    public function registrants()
    {
        return $this->hasMany(WebinarRegistrant::class, 'webinars', 'webinar_id', ['occurrence_id' => $this->occurrence_id]);
    }

    public function find($id)
    {
        $occurence = $this->newQuery()->addQuery('occurrence_id', $id)->find($this->webinar_id);
        $occurence->webinar_id = $this->webinar_id;
        $occurence->occurrence_id = $id;

        return $occurence;
    }

    public function getPatchEndPoint()
    {
        if ($this->hasCustomEndPoint('patch')) {
            return $this->getCustomEndPoint('patch').$this->getKeyForEndPoint();
        }

        return $this->endPoint.'?occurrence_id='.$this->getKey();
    }

    public function getDeleteEndPoint()
    {
        if ($this->hasCustomEndPoint('delete')) {
            return $this->getCustomEndPoint('delete').$this->getKeyForEndPoint();
        }

        return $this->endPoint.'?occurrence_id='.$this->getKey();
    }

    public function delete($scheduleForReminder = true)
    {
        return $this->newQuery()->addQuery('schedule_for_reminder', $scheduleForReminder)->delete();
    }
}
