<?php 
namespace MacsiDigital\Zoom\Classes;

class User extends Model
{

	protected $attributes = [
		'first_name' => '', //string
    	'last_name' => '', //string
    	'email' => '', //string
    	'type' => '', //integer
    	'pmi' => '', //string
    	'timezone' => '', //string
    	'dept' => '', //string
    	'created_at' => '', //string [date-time]
    	'last_login_time' => '', //string [date-time]
    	'last_client_version' => '', //string
    	'vanity_url' => '', // string
    	'personal_meeting_url' => '', // string
    	'verified' => '', // integer
    	'pic_url' => '', // string
    	'cms_user_id' => '', // string
    	'account_id' => '', // string
    	'host_key' => '', // string
    	'group_ids' => [],
    	'im_group_ids' => [],
    	'password' => '',
        'id' => '',
    ];

}