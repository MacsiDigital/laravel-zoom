<?php

namespace MacsiDigital\Zoom\Support;

use MacsiDigital\API\Support\Authentication\JWT;
use MacsiDigital\API\Support\Entry as ApiEntry;
use MacsiDigital\Zoom\Facades\Client;

class Entry extends ApiEntry
{
    protected $modelNamespace = '\MacsiDigital\Zoom\\';

    protected $pageField = 'page_number';

    protected $maxQueries = '5';

    // Amount of pagination results per page by default, leave blank if should not paginate
    // Without pagination rate limits could be hit
    protected $defaultPaginationRecords = '30';

    // Max and Min pagination records per page, will vary by API server
    protected $maxPaginationRecords = '300';

    protected $resultsPageField = 'page_number';
    protected $resultsTotalPagesField = 'page_count';
    protected $resultsPageSizeField = 'page_size';
    protected $resultsTotalRecordsField = 'total_records';

    protected $allowedOperands = ['='];

    public function __construct()
    {
        if (config('zoom.max_api_calls_per_request') != null) {
            $this->maxQueries = config('zoom.max_api_calls_per_request');
        }
    }

    public function newRequest()
    {
        if (config('zoom.authentication_method') == 'jwt') {
            return $this->jwtRequest();
        } elseif (config('zoom.authentication_method') == 'oauth2') {
        }
    }

    public function jwtRequest()
    {
        $jwtToken = JWT::generateToken(['iss' => config('zoom.api_key'), 'exp' => time() + config('zoom.token_life')], config('zoom.api_secret'));
        
        return Client::baseUrl(config('zoom.base_url'))->withToken($jwtToken);
    }

    public function oauth2Request()
    {
    }
}
