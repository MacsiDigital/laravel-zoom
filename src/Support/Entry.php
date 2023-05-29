<?php

namespace MacsiDigital\Zoom\Support;

use Illuminate\Support\Facades\Http;
use MacsiDigital\Zoom\Facades\Client;
use MacsiDigital\API\Support\Entry as ApiEntry;
use MacsiDigital\API\Support\Authentication\JWT;
use MacsiDigital\API\Support\Authentication\OAuth1;

class Entry extends ApiEntry
{
    protected $modelNamespace = '\MacsiDigital\Zoom\\';

    protected $pageField = 'page_number';

    protected $maxQueries = '5';

    protected $accountId = null;

    protected $apiKey = null;

    protected $apiSecret = null;

    protected $tokenLife = null;

    protected $baseUrl = null;

    protected $siteUrl = null;

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

    /**
     * Entry constructor.
     * @param $apiKey
     * @param $apiSecret
     * @param $tokenLife
     * @param $maxQueries
     * @param $baseUrl
     */
    public function __construct($apiKey = null, $apiSecret = null, $tokenLife = null, $maxQueries = null, $baseUrl = null, $accountId = null, $siteUrl = null)
    {
        $this->apiKey = $apiKey ? $apiKey : config('zoom.api_key');
        $this->apiSecret = $apiSecret ? $apiSecret : config('zoom.api_secret');
        $this->tokenLife = $tokenLife ? $tokenLife : config('zoom.token_life');
        $this->maxQueries = $maxQueries ? $maxQueries : (config('zoom.max_api_calls_per_request') ? config('zoom.max_api_calls_per_request') : $this->maxQueries);
        $this->baseUrl = $baseUrl ? $baseUrl : config('zoom.base_url');
        $this->accountId = $accountId ? $accountId : config('zoom.account_id');
        $this->siteUrl = $siteUrl ? $siteUrl : config('zoom.site_url');
    }

    public function newRequest()
    {
        if (config('zoom.authentication_method') == 'jwt') {
            return $this->jwtRequest();
        } elseif (config('zoom.authentication_method') == 'oauth2') {
            return $this->oauth2Request();
        }
    }

    public function jwtRequest()
    {
        $jwtToken = JWT::generateToken(['iss' => $this->apiKey, 'exp' => time() + $this->tokenLife], $this->apiSecret);

        return Client::baseUrl($this->baseUrl)->withToken($jwtToken);
    }

    public function oauth2Request()
    {
        $oAuthToken = null;

        try {
            $data = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret),
            ])->post($this->siteUrl . '/oauth/token?grant_type=account_credentials&account_id=' . $this->accountId)->json();

            if (isset($data['error'])) {
                throw new \Exception($data['error'] . ': ' . $data['reason']);
            }

            $oAuthToken = $data['access_token'];
        } catch (\Throwable $th) {
            throw $th;
        }

        return Client::baseUrl($this->baseUrl)->withToken($oAuthToken);
    }
}
