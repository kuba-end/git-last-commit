<?php

namespace KubaEnd\Commands;

use KubaEnd\Commands\Abstracts\CreateClient;
use KubaEnd\Commands\Interfaces\ProcessResponseInterface;

class BitbucketConnect extends CreateClient implements ProcessResponseInterface {
    private string $nick;
    private string $repo;
    public function getLastCommitSha($nick,$repo):object{
        $client=$this->mkClient();
        $this->nick=$nick;
        $this->repo=$repo;
        $request = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$nick.'/'.$repo.'/commits');
        return $request->getBody();
    }
    public function decode(){
        $responseAsArray = (json_decode($this->getLastCommitSha($this->nick,$this->repo),true));
        return ($responseAsArray["values"][0]["hash"]);
    }
    public function showSha(){
        echo "Sha of your last commit is: ".$this->decode().PHP_EOL;
    }
}
