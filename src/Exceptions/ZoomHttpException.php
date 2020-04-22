<?php

namespace MacsiDigital\Zoom\Exceptions;

class ZoomHttpException extends \Exception
{
    public function __construct($code = 0, $errorResponse = [], \Throwable $previous = null)
    {
        $message = $errorResponse['message'];
        parent::__construct($message, $code, $previous);
    }
}
