<?php

namespace MacsiDigital\Zoom;

use Exception;
use MacsiDigital\Zoom\Support\Model;

class Recording extends Model
{

    const ENDPOINT = 'recordings';

    protected $methods = ['get', 'post', 'patch', 'put', 'delete'];
    public $response;
    protected $attributes = [
        'uuid' => '',
        'id' => '',
        'account_id' => '',
        'host_id' => '',
        'topic' => '',
        'start_time' => '',
        'duration' => '',
        'total_size' => '',
        'recording_count' => '',
        'recording_files' => [],
        // all
        'from' => '',
        'to' => '',
        'page_count' => '',
        'page_size' => '',
        'total_records' => '',
        'next_page_token' => '',
        'meetings' => []
    ];

    /**
     * Get all recordings by user
     * 
     * @param string $userId zoom user id
     * @return array
     * @throws Exception
     */
    public function userRecordings(string $userId): array
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get("users/{$userId}/" . $this->getEndPoint() . '?from=' . date('Y-m-d', strtotime('-3 months')));
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody())->first()->getAttributes()['meetings'];
            } else {
                throw new Exception($this->response->getStatusCode() . ' status code');
            }
        }
    }

    public function meetingRecordings($meetingId): array
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get("meetings/{$meetingId}/" . $this->getEndPoint());
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody())->first()->getAttributes();
            } else {
                throw new Exception($this->response->getStatusCode() . ' status code');
            }
        }
    }

    public function deleteFromCloud($meetingId)
    {
        if (in_array('delete', $this->methods)) {
            $this->response = $this->client->delete("meetings/{$meetingId}/" . $this->getEndPoint() . '?action=delete');
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody())->first()->getAttributes();
            } else {
                throw new Exception($this->response->getStatusCode() . ' status code');
            }
        }
    }

}
