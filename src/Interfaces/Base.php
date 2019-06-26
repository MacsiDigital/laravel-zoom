<?php

namespace MacsiDigital\Zoom\Interfaces;

use Exception;
use MacsiDigital\Zoom\Support\Response;

abstract class Base
{
    protected $request;

    public function get($end_point)
    {
        try {
            return new Response($this->request->get($end_point));
        } catch (Exception $e) {
            return new Response($e->getResponse());
        }
    }

    public function post($end_point, $fields)
    {
        try {
            return new Response($this->request->post($end_point, $fields));
        } catch (Exception $e) {
            return new Response($e->getResponse());
        }
    }

    public function put($end_point, $fields)
    {
        try {
            return new Response($this->request->put($end_point, $fields));
        } catch (Exception $e) {
            return new Response($e->getResponse());
        }
    }

    public function patch($end_point, $fields)
    {
        try {
            return new Response($this->request->patch($end_point, $fields));
        } catch (Exception $e) {
            return new Response($e->getResponse());
        }
    }

    public function delete($end_point)
    {
        return new Response($this->request->delete($end_point));
    }
}
