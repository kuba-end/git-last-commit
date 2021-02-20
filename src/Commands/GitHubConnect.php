<?php

namespace KubaEnd\Commands;

use GuzzleHttp\Client;


class GitHubConnect{
    public function getLastCommitSha($nick,$repo){
        $client = new Client();
        $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
        $response =$request->getBody();
        $responseAsArray = json_decode($response,true);
        $lastCommitSha = ($responseAsArray[0]["sha"]);
        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL;
        }
}
