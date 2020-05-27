<?php

namespace MacsiDigital\Zoom\Support;

use Illuminate\Support\Str;
use MacsiDigital\API\Support\ApiResource;

class Model extends ApiResource
{
	protected $apiDataField = '';

	protected $dateFormat = \DateTime::ATOM;

}