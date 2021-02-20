<?php
 namespace KubaEnd\Commands\Abstracts;

 use GuzzleHttp\Client;


 abstract class PlatformConnect{
  public function mkClient()
  {
      return $client = new Client();
  }
 }