<?php

namespace KubeEnd\Controller;

use GuzzleHttp\Client;

$client = new Client();
$request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
$request1 = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$nick.'/'.$repo.'/commits');

$response =$request->getBody();
$response_as_array = ((json_decode($response,true)));
$last_commit_sha = ($response_as_array[0]["sha"]);
$last_commit_url = ($response_as_array[0]["html_url"]);

class ChoosePlatform{

}