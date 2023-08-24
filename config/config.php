<?php

return [
    'api_key' => env('ZOOM_CLIENT_KEY'), // For OAuth2 this is the Client ID
    'api_secret' => env('ZOOM_CLIENT_SECRET'), // For OAuth2 this is the Client Secret
    'account_id' => env('ZOOM_ACCOUNT_ID'),
    'base_url' => 'https://api.zoom.us/v2/',
    'token_life' => 60 * 60 * 24 * 7, // In seconds, default 1 week
    'authentication_method' => 'oauth2', // you can use 'jwt' or 'oauth2' (default jwt) oauth2 is use Server-to-sever OAuth
    'max_api_calls_per_request' => '5', // how many times can we hit the api to return results for an all() request
    'site_url' => 'https://zoom.us', // This is the url for oauth2 authenication
];
