<?php
namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\Zoom\Http\Request;
use MacsiDigital\Zoom\Classes\Meeting as Model;

class Meeting extends Request
{

    /**
     * List
     *
     * @param string $userId
     * @return array|mixed
     */
    public function list($userId)
    {
        $response = $this->get("users/{$userId}/meetings");
        $meetings = [];
        foreach($response['meetings'] as $meeting){
            $meetings[] = Model::instantiate($meeting);
        }
        return $meetings;
    }

    /**
     * Create
     *
     * @param string $userId
     * @param array $data
     * @return array|mixed
     */
    public function create($userId, Model $meeting)
    {
        return $this->post("users/{$userId}/meetings", $meeting);
    }

    /**
     * Meeting
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function retrieve($meetingId)
    {
        return Model::instantiate($this->get("meetings/{$meetingId}"));
    }

    /**
     * Update
     *
     * @param string $meetingId
     * @param array $data
     * @return array|mixed
     */
    public function update($meetingId, Model $meeting)
    {
        return $this->patch("meetings/{$meetingId}", $meeting);
    }

    /**
     * Delete
     *
     * @param string $meetingId
     * @return array|mixed
     */
    public function delete($meetingId)
    {
        return $this->delete("meetings/{$meetingId}");
    }

    /**
     * List Registrants
     *
     * @param string $meetingId
     * @param string $status
     * @return array|mixed
     */
    public function listRegistrants($meetingId)
    {
        $response = $this->get("meetings/{$meetingId}/registrants");
        $registrants = [];
        foreach($response['registrants'] as $registrant){
            $registrants[] = Registrant::instantiate($reggistrant);
        }
        return $registrants;
    }

    /**
     * Add Registrant
     *
     * @param string $meetingId
     * @param array $registrant
     * @return array|mixed
     */
    public function addRegistrant($meetingId, $registrant)
    {
        $allowed_fields = ["email", "first_name", "last_name", "address", "city", "country", "zip", "state", "phone", "industry", "org", "job_title", "purchasing_time_frame", "role_in_purchase_process", "no_of_employees", "comments", "custom_questions"];
        $reg = [];
        foreach($allowed_fields as $field){
            if($registrant->$field != ""){
                $reg[$field] = $registrant->$field;
            }
        }
        return $this->post("meetings/{$meetingId}/registrant", $reg);
    }

    /**
     * Add Registrant
     *
     * @param string $meetingId
     * @param array $registrant
     * @param string $action
     * @return array|mixed
     */
    public function updateRegistrantStatus($meetingId, $registrants, $action)
    {
        $reges = [];
        foreach($registrants as $registrant){
            $reges[] = ['id' => $registrant->id, 'email' => $registrant->email];
        }
        return $this->patch("meetings/{$meetingId}/registrants/status", ['action' => $action, 'registrants' => $reges]);
    }

    // /**
    //  * Records
    //  *
    //  * @param string $meetingId
    //  * @return array|mixed
    //  */
    // public function records($meetingId)
    // {
    //     return $this->get("meetings/{$meetingId}/recordings");
    // }

}