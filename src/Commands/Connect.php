<?php

namespace KubaEnd\Commands;
use GuzzleHttp\Client;
use KubaEnd\Commands\Abstracts\CreateClient;

class Connect extends CreateClient
{
    private $word;
    public function __construct($word)
    {
        $this->word=$word;
    }
    public function getLastCommitSha()
    {
        $client=$this->mkClient();
        $this->nick=$nick;
        $this->repo=$repo;
        $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
        return $request->getBody();
	}
}

class GitHubConnect extends CreateClient {
    public $word;
    public function getLastCommitSha()
    {
        $this->word=$this->mkClient();
        return $word->request('GET',
            'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
    }
}

$client = new Connect(new GitHubConnect());
var_dump($client1->getLastCommitSha('kuba-end','git-last-commit'));