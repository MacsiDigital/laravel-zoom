<?php

namespace MacsiDigital\Zoom\Exceptions;

use Exception;

class FileTooLargeException extends Exception
{
    public function __construct($file, $size, $allowedSize)
    {
        parent::__construct($file.' is '.$size.'MB and is larger than the maximum allowed size for uploads of '.$allowedSize);
    }
}
