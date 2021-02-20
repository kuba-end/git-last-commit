<?php

namespace KubaEnd\Commands;
use GuzzleHttp\Client;

class BitbucketConnect{
    public function getLastCommitSha($nick,$repo){
        $client = new Client();
        $request = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$nick.'/'.$repo.'/commits');
        $response =$request->getBody();
        $responseAsArray = (json_decode($response,true));
        $lastCommitSha = ($responseAsArray["values"][0]["hash"]);

        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL;
    }
}
