#!/usr/bin/env php
<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

/*$nick = readline("Wpisz swój login: ");
$repo = readline("Wpisz nazwę repozytorium: ");

$client = new Client();
$request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
//echo $request->getStatusCode().PHP_EOL;
//echo $request->getHeaderLine('content-type').PHP_EOL;
$response =$request->getBody();
$response_as_array = ((json_decode($response,true)));
//print_r($response_as_array[0]);
$last_commit_sha = ($response_as_array[0]["sha"]);
$last_commit_url = ($response_as_array[0]["html_url"]);
if (isset($last_commit_sha) && strlen($last_commit_sha)===40){

    echo "Sha of your last commit is: ".PHP_EOL;
    print_r($last_commit_sha);
    echo PHP_EOL;
}
if (isset($last_commit_url) && str_starts_with($last_commit_url,"https://github.com")){
    echo "There is link for it:".PHP_EOL;
    print_r($last_commit_url);
    echo PHP_EOL;
}*/
$LastRequest = new GitRequest();
echo $LastRequest->lastCommit($nick=readline("Podaj swój login: "),$repo=readline('Podaj nazwę repozytorium: '));

