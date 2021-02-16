<?php

namespace KubaEnd\Model;
use GuzzleHttp\Client;

class GitLabConnect{
    public function connecting($projectId){
        $client = new Client();
        $request = $client->request('GET','https://gitlab.com/api/v4/projects/'.$projectId.'/repository/commits');
        $response = $request->getBody();
        $responseAsArray = ((json_decode($response,true)));
        $lastCommitSha = ($responseAsArray[0]["id"]);
        $lastCommitUrl = ($responseAsArray[0]["web_url"]);
        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL.$lastCommitUrl.PHP_EOL;
    }
}