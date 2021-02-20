<?php

namespace KubaEnd\Commands;

use KubaEnd\Commands\Abstracts\PlatformConnect;
use KubaEnd\Commands\Interfaces\ProcessResponseInterface;


class GitHubConnect extends PlatformConnect implements ProcessResponseInterface {
    private string $nick;
    private string $repo;
    public function getLastCommitSha($nick,$repo):object{
        $client=$this->mkClient();
        $this->nick=$nick;
        $this->repo=$repo;
        $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
        return $request->getBody();
        }
    public function decode():string{
        $responseAsArray = json_decode($this->getLastCommitSha($this->nick,$this->repo),true);
        return ($responseAsArray[0]["sha"]);

        }
    public function showSha(){
        echo "Sha of your last commit is: ".$this->decode().PHP_EOL;
        }
}
