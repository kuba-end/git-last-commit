<?php

namespace KubaEnd\Model;

use GuzzleHttp\Client;

class GitHubConnect{
    public function connecting($nick,$repo)
    {
        $client = new Client();
        $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
        $response =$request->getBody();
        $responseAsArray = ((json_decode($response,true)));
        $lastCommitSha = ($responseAsArray[0]["sha"]);
        $lastCommitUrl = ($responseAsArray[0]["html_url"]);
        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL.$lastCommitUrl.PHP_EOL;
    }
}
