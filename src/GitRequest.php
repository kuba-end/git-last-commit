<?php

//namespace MyApp;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GitRequest extends Client{
    public function lastCommit ($nick,$repo){
    $client = new Client();
    $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
    $response =$request->getBody();
    $responseAsArray = ((json_decode($response,true)));
    $lastCommitSha = ($responseAsArray[0]["sha"]);
    $lastCommitUrl = ($responseAsArray[0]["html_url"]);
    return $lastCommitSha.PHP_EOL.$lastCommitUrl;
    }
}

//$commit = new GitRequest();
//$commit->lastCommit($nick = readline("Login :"),$repo = readline("Repo :"));