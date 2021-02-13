<?php
namespace KubeEnd\Controller;
require "../../vendor/autoload.php";


use GuzzleHttp\Client;

//$nick = "kuba-end";
//$repo = "kuba-end";
$workspace = "kuba-end";
$repoSlug = "last-git-commit";

$client = new Client();
/*$request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
$response =$request->getBody();
$response_as_array = ((json_decode($response,true)));
$last_commit_sha = ($response_as_array[0]["sha"]);
$last_commit_url = ($response_as_array[0]["html_url"]);*/

$request1 = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$workspace.'/'.$repoSlug.'/commits');
$response1 =$request1->getBody();
//var_dump($response1);
$response_as_array1 = ((json_decode($response1,true)));
var_dump($response_as_array1);
$last_commit_sha1 = ($response_as_array1["values"][0]["hash"]);
//$last_commit_url1 = ($response_as_array1[0]["html_url"]);

//echo $last_commit_sha.PHP_EOL;
//echo $last_commit_url.PHP_EOL;
echo $last_commit_sha1.PHP_EOL;
//echo $last_commit_url1.PHP_EOL;


