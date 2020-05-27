<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Panelist extends Model
{
    protected $insertResource = 'MacsiDigital\Zoom\Requests\StorePanelist';
    
    protected $endPoint = 'webinars/{webinar:id}/panelists';

    protected $allowedMethods = ['get', 'post', 'put'];

    protected $apiMultipleDataField = '';

    public function updateAction($action){
        $this->action = $action;
        return $this;
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
