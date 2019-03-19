<?php
namespace MacsiDigital\Zoom;

use Illuminate\Support\Facades\Facade;


class ZoomFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Zoom';
    }
}