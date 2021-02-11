<?php

namespace Model;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class LastCommit extends Command
{
    protected static $defaultName = "showCommit";
    protected function configure()
    {
        parent::configure();
        $this->setDescription('Show info about your last git commit')
            ->setHelp('Idzie polak, rusek i niemiec')
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $helper = $this->getHelper('question');
        $question = new Question('Podaj swój login : ');
        $question1 = new Question('Podaj nazwę repozytorium : ');
        $nick = $helper->ask($input,$output,$question);
        $repo = $helper->ask($input,$output,$question1);

        $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
        $response =$request->getBody();
        $response_as_array = ((json_decode($response,true)));
        $last_commit_sha = ($response_as_array[0]["sha"]);
        $last_commit_url = ($response_as_array[0]["html_url"]);
        echo $last_commit_sha.PHP_EOL.$last_commit_url.PHP_EOL;
        return Command::SUCCESS;

    }

    }
