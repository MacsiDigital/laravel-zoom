<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class MeetingOccurrence extends Model
{
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateOccurrence';

    protected $endPoint = 'meetings/{meeting:id}';

    protected $allowedMethods = ['find', 'get', 'patch', 'delete'];

    protected $apiDataField = '';

    protected $apiMultipleDataField = 'occurrences';

    protected $primaryKey = 'occurrence_id';

    public function registrants()
    {
        return $this->hasMany(MeetingRegistrant::class, 'meetings', 'meeting_id', ['occurrence_id' => $this->occurrence_id]);
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

    public function find($id)
    {
        $occurence = $this->newQuery()->addQuery('occurrence_id', $id)->getOne();
        $occurence->meeting_id = $this->meeting_id;
        $occurence->occurrence_id = $id;

        return $occurence;
    }

    public function delete($scheduleForReminder = true)
    {
        return $this->newQuery()->addQuery('schedule_for_reminder', $scheduleForReminder)->delete();
    }
}
