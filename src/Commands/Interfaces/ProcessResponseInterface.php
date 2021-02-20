<?php

namespace KubaEnd\Commands\Interfaces;
use GuzzleHttp\Client;

interface ProcessResponseInterface {
    public function decode();
    public function showSha();
}

