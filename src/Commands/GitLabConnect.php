<?php

namespace KubaEnd\Commands;
use GuzzleHttp\Client;

class GitLabConnect{
    public function getLastCommitSha($projectId){
        $client = new Client();
        $request = $client->request('GET','https://gitlab.com/api/v4/projects/'.$projectId.'/repository/commits/:sha');
        var_dump($request);
        $response = $request->getBody();
        $responseAsArray = ((json_decode($response,true)));
        $lastCommitSha = ($responseAsArray[0]["id"]);

        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL;
    }
}