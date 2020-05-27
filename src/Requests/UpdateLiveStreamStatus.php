<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class UpdateLiveStream extends PersistResource
{

    protected $persistAttributes = [
    	"action" => "required|in:start,stop",
  	];

  	protected $relatedResource = [
    	"settings" => UpdateLiveStreamStatusSetting::class,
    ];
}