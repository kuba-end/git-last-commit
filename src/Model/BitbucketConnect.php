<?php

namespace KubaEnd\Model;
use GuzzleHttp\Client;

class BitbucketConnect{
    public function connecting($workspace,$repoSlug){
        $client = new Client();
        $request = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$workspace.'/'.$repoSlug.'/commits');
        $response =$request->getBody();
        $responseAsArray = ((json_decode($response,true)));
        $lastCommitSha = ($responseAsArray["values"][0]["hash"]);
        $lastCommitUrl = ($responseAsArray["values"][0]["repository"]["links"]["html"]["href"]);
        echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL.$lastCommitUrl.PHP_EOL;
    }
}
