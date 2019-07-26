<?php

namespace MacsiDigital\Zoom;

use Exception;
use Illuminate\Support\Str;
use MacsiDigital\Zoom\Interfaces\PrivateApplication;

class Zoom
{
    protected $client;

    public function __construct($type = 'Private')
    {
        $function = 'boot'.ucfirst($type).'Application';
        if (method_exists($this, $function)) {
            $this->$function();
        } else {
            throw new Exception('Application Interface type not known');
        }
    }

    public function bootPrivateApplication()
    {
        $this->client = (new PrivateApplication());
    }

    public function getClient()
    {
        return $this->client;
    }

    public function __get($key)
    {
        return $this->getNode($key);
    }

    public function getNode($key)
    {
        $class = 'MacsiDigital\Zoom\\'.Str::studly($key);
        if (class_exists($class)) {
            return new $class();
        }
        throw new Exception('Wrong method');
    }
}
