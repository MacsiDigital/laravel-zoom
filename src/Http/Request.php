<?php
namespace MacsiDigital\Zoom\Http;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

class Request
{
    protected $client;
    protected $headers;
    protected $endPoint = 'https://api.zoom.us/v2/';

    public function __construct()
    {
        $this->client = new Client();
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->generateJWT(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function generateJWT(){
        $token = [
            "iss" => config('zoom.api_key'),
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
            "exp" => time() + 60
        ];
        return JWT::encode($token, config('zoom.api_secret'));
    }

    /**
     * Get
     *
     * @param $method
     * @param array $fields
     * @return array|mixed
     */
    protected function get($method, $fields = [])
    {
        try {
            $response = $this->client->request('GET', $this->endPoint . $method, [
                'query' => $fields,
                'headers' => $this->headers,
            ]);
            return $this->result($response);
        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Post
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function post($method, $fields = [])
    {
        $body = json_encode($fields);
        try {
            $response = $this->client->request('POST', $this->endPoint . $method, [
                'body' => $body, 
                'headers' => $this->headers
            ]);
            return $this->result($response);
        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Patch
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function patch($method, $fields = [])
    {
        $body = json_encode($fields);
        try {
            $response = $this->client->request('PATCH', $this->endPoint . $method, [
                'body' => $body,
                'headers' => $this->headers
            ]);

            return $this->result($response);
        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Patch
     *
     * @param $method
     * @param $fields
     * @return array|mixed
     */
    protected function put($method, $fields = [])
    {
        $body = json_encode($fields);
        try {
            $response = $this->client->request('PUT', $this->endPoint . $method, [
                'body' => $body,
                'headers' => $this->headers
            ]);

            return $this->result($response);
        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    protected function delete($method)
    {
        try {
            $response = $this->client->request('DELETE', $this->endPoint . $method, [
                'headers' => $this->headers
            ]);
            return $this->result($response);
        } catch (ClientException $e) {
            return (array)json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Result
     *
     * @param Response $response
     * @return mixed
     */
    protected function result(Response $response)
    {
        $result = json_decode((string)$response->getBody(), true);
        $result['code'] = $response->getStatusCode();
        return $result;
    }
}