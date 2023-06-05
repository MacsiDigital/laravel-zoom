<?php

namespace MacsiDigital\Zoom\Support;

use MacsiDigital\API\Support\Authentication\JWT;
use MacsiDigital\API\Support\Authentication\OAuth;
use MacsiDigital\API\Support\Authentication\OAuth1;
use MacsiDigital\API\Support\Entry as ApiEntry;
use MacsiDigital\OAuth2\Providers\OAuth2ServiceProvider;
use MacsiDigital\Zoom\Facades\Client;


class Entry extends ApiEntry
{
    protected $modelNamespace = '\MacsiDigital\Zoom\\';

    protected $pageField = 'page_number';

    protected $maxQueries = '5';

    protected $accountId = null;

    protected $clientId = null;

    protected $clientSecret = null;

    protected $baseUrl = null;

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
     * @param $accountId
     * @param $clientId
     * @param $clientSecret
     * @param $maxQueries
     * @param $baseUrl
     */
    public function __construct($accountId = null, $clientId = null, $clientSecret = null, $maxQueries = null, $baseUrl = null)
    {
        $this->accountId = $accountId ? $accountId : config('zoom.account_id');
        $this->clientId = $clientId ? $clientId : config('zoom.client_id');
        $this->clientSecret = $clientSecret ? $clientSecret : config('zoom.client_secret');
        $this->maxQueries = $maxQueries ? $maxQueries : (config('zoom.max_api_calls_per_request') ? config('zoom.max_api_calls_per_request') : $this->maxQueries);
        $this->baseUrl = $baseUrl ? $baseUrl : config('zoom.base_url');
    }

    public function newRequest()
    {

        if (config('zoom.authentication_method') == 'Oauth') {
            return $this->oauthRequest();
        }
    }


    public function oauthRequest()
    {
        $oauth = $this->OAuthGenerateToken();

        return Client::baseUrl($this->baseUrl)->withToken($oauth['access_token']);
    }

    private function OAuthGenerateToken()
    {
        return \Illuminate\Support\Facades\Http::asForm()
            ->withHeaders([
                'Authorization' => ['Basic ' . base64_encode("$this->clientId:$this->clientSecret")]
            ])->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => $this->accountId,
            ]);
    }
}
