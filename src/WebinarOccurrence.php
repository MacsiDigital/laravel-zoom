<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class WebinarOccurrence extends Model
{
    protected $updateResource = 'MacsiDigital\Zoom\Requests\UpdateOccurrence';
    
    protected $endPoint = 'webinars/{webinar:id}';

    protected $allowedMethods = ['find', 'get', 'patch', 'delete'];

    protected $apiDataField = '';

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

    public function beforeUpdating($query) 
    {
        If(!$this->hasKey()){
            return false;
        }
        return $query->where('occurrence_id', $this->id);
    }

    public function delete($scheduleForReminder=true)
    {
        return $this->newQuery()->addQuery('schedule_for_reminder', $scheduleForReminder)->delete();
    }

    public function beforeDeleting($query) 
    {
        If(!$this->hasKey()){
            return false;
        }
        return $query->where('occurrence_id', $this->id);
    }
}
