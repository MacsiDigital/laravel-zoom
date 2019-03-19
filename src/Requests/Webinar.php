<?php
namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\Zoom\Http\Request;
use MacsiDigital\Zoom\Classes\Webinar as Model;
use MacsiDigital\Zoom\Classes\Panelist;
use MacsiDigital\Zoom\Classes\Registrant;

class Webinar extends Request
{

    /**
     * List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function list($userId, $fields)
    {
        $response = $this->get("users/{$userId}/webinars", $fields);
        $webinars = [];
        foreach($response['webinars'] as $webinar){
            $webinars[] = Model::instantiate($webinar);
        }
        return $webinars;
    }

    /**
     * Create
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function create($userId, Model $webinar)
    {
        return $this->post("users/{$userId}/webinars", $webinar);
    }

    /**
     * Meeting
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function retrieve($webinarId)
    {
        dd($this->get("webinars/{$webinarId}"));
        return Model::instantiate($this->get("webinars/{$webinarId}"));
    }

    /**
     * Update
     *
     * @param string $webinarId
     * @param array $data
     * @return array|mixed
     */
    public function update($webinarId, Model $webinar)
    {
        return $this->patch("webinars/{$webinarId}", $webinar);
    }

    /**
     * Delete
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function delete($webinarId)
    {
        return $this->delete("webinars/{$webinarId}");
    }

    /**
     * Update Status
     *
     * @param string $webinarId
     * @param string $status
     * @return array|mixed
     */
    public function updateStatus($webinarId, $status)
    {
    	return $this->put("webinars/{$webinarId}", ['status' => $status]);
    }

    /**
     * List Panelists
     *
     * @param string $webinarId
     * @param string $status
     * @return array|mixed
     */
    public function listPanelists($webinarId, $fields)
    {
    	$response = $this->get("webinars/{$webinarId}/panelists", $fields);
    	$panelists = [];
    	foreach($response['panelists'] as $panelist){
    		$panelists[] = Panelist::instantiate($panelist);
    	}
    	return $panelists;
    }

    /**
     * Add Panelists
     *
     * @param string $webinarId
     * @param array $panelists
     * @return array|mixed
     */
    public function addPanelists($webinarId, $panelists)
    {
    	$panel = [];
    	foreach($apnelists as $panelist){
    		$panel[] = ['name' => $panelist->name, 'email' => $panelist->email];
    	}
    	return $this->post("webinars/{$webinarId}/panelists", ['panelists' => $panel]);
    }

    /**
     * Remove Panelists
     *
     * @param string $webinarId
     * @return array|mixed
     */
    public function removePanelists($webinarId)
    {
    	return $this->delete("webinars/{$webinarId}/panelists");
    }

    /**
     * Remove Panelist
     *
     * @param string $webinarId
     * @param string $panalisId
     * @return array|mixed
     */
    public function removePanelist($webinarId, $panelistId)
    {
    	return $this->delete("webinars/{$webinarId}/panelists/{$panelistId}");
    }

    /**
     * List Registrants
     *
     * @param string $webinarId
     * @param string $status
     * @return array|mixed
     */
    public function listRegistrants($webinarId, $fields)
    {
    	$response = $this->get("webinars/{$webinarId}/registrants", $fields);
    	$registrants = [];
    	foreach($response['registrants'] as $registrant){
    		$registrants[] = Registrant::instantiate($registrant);
    	}
    	return $registrants;
    }

    /**
     * Add Registrant
     *
     * @param string $webinarId
     * @param array $registrant
     * @return array|mixed
     */
    public function addRegistrant($webinarId, Registrant $registrant)
    {
    	$allowed_fields = ["email", "first_name", "last_name", "address", "city", "country", "zip", "state", "phone", "industry", "org", "job_title", "purchasing_time_frame", "role_in_purchase_process", "no_of_employees", "comments", "custom_questions"];
    	$reg = [];
    	foreach($allowed_fields as $field){
    		if($registrant->$field != "" && $registrant->$field != []){
    			$reg[$field] = $registrant->$field;
    		}
    	}
    	return $this->post("webinars/{$webinarId}/registrants", $reg);
    }

    /**
     * Add Registrant
     *
     * @param string $webinarId
     * @param array $registrant objects
     * @param string $action
     * @return array|mixed
     */
    public function updateRegistrantStatus($webinarId, $registrants, $action)
    {
    	$reges = [];
    	foreach($registrants as $registrant){
	    	$reges[] = ['id' => $registrant->id, 'email' => $registrant->email];
    	}
    	return $this->put("webinars/{$webinarId}/registrants/status", ['action' => $action, 'registrants' => $reges]);
    }

    /**
     * Get Past Webinar Instances
     *
     * @param string $webinarId
     * @param array $registrant
     * @param string $action
     * @return array|mixed
     */
    public function pastInstances($webinarId)
    {
    	$response = $this->get("past_webinars/{$webinarId}/instances");
        $webinars = [];
        foreach($response['webinars'] as $webinar){
            $webinars[] = Model::instantiate($webinar);
        }
        return $webinars;
    }

}