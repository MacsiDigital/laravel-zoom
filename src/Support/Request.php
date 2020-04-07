<?php

namespace MacsiDigital\Zoom\Support;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Request
{
    protected $client;

    private const DEFAULT_TIMEOUT = 10;

    public function bootPrivateApplication()
    {
        $options = [
            'base_uri' => 'https://api.zoom.us/v2/',
            'headers' => [
                'Authorization' => 'Bearer '.$this->generateJWT(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Origin' => 'https://developer.zoom.us',
            ],
            'timeout' => self::DEFAULT_TIMEOUT,
        ];
        $this->client = new Client($options);

        return $this;
    }

    public function generateJWT()
    {
        $token = [
            'iss' => config('zoom.api_key'),
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
            'exp' => time() + 60,
        ];

        return JWT::encode($token, config('zoom.api_secret'));
    }

    public function get($end_point, $query = '')
    {
        try {
            return $this->client->request('GET', $end_point);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            throw new Exception('Undefined Exception: ' . $e->getMessage());
        }
    }

    public function post($end_point, $fields)
    {
        try {
            return $this->client->post($end_point, [
                'body' => $this->prepareFields($fields),
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            throw new Exception('Undefined Exception: ' . $e->getMessage());
        }
    }

    public function patch($end_point, $fields)
    {
        try {
            return $this->client->patch($end_point, [
                'body' => $this->prepareFields($fields),
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            throw new Exception('Undefined Exception: ' . $e->getMessage());
        }
    }

    public function put($end_point, $fields)
    {
        try {
            return $this->client->put($end_point, [
                'body' => $this->prepareFields($fields),
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            throw new Exception('Undefined Exception: ' . $e->getMessage());
        }
    }

    public function delete($end_point)
    {
        try {
            return $this->client->delete($end_point, [
                'headers' => $this->headers,
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            throw new Exception('Undefined Exception: ' . $e->getMessage());
        }
    }

    private function prepareFields($fields)
    {
        return json_encode($fields);
    }
}
