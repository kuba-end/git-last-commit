<?php

namespace KubaEnd\Commands\Abstracts;
require_once ('/home/ciecierzyca/PhpstormProjects/last_commit/vendor/guzzlehttp/guzzle/src/Client.php');
use GuzzleHttp\Client;


 abstract class CreateClient{
  public function mkClient()
  {
      return $client = new Client();
  }
 }
