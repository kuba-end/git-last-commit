<?php

namespace KubaEnd\Commands\Interfaces;
use GuzzleHttp\Client;

interface DecodeResponseInterface {
    public function decode($response);
}

