<?php

namespace MacsiDigital\Zoom\Contracts;

interface Zoom
{
    public function __construct($type = 'Private');

    public function getClient();

    public function __get($key);

    public function getNode($key);
}
