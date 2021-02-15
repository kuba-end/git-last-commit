<?php

namespace KubaEnd\Controller;
require "../../vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;

class LastCommitFrom extends Command{
    protected static $defaultName = "Commit";
    protected function configure()
    {
        parent::configure();
        $this->setDescription('Show info about your last commit')
            ->setHelp('Type your login in first input area and name of repository you want to get the result from')
        ;
    }
     public function execute(InputInterface $input, OutputInterface $output){
      $helper=$this->getHelper('question');
      $question = new ChoiceQuestion(
          "Please select platform from which you want to get information about your last commit (default Github)",["GitHub","Bitbucket","GitLab"],0
      );
      $question->setErrorMessage('Platform %s is invalid');
      $platform = $helper->ask($input,$output,$question);
      $output->writeln($platform." selected");
      switch ($platform){
          case "GitHub":
              $client = new Client();
              $question = new Question('Insert your login : ');
              $question1 = new Question('Insert repo name : ');
              $nick = $helper->ask($input,$output,$question);
              $repo = $helper->ask($input,$output,$question1);
              $request = $client->request('GET', 'https://api.github.com/repos/'.$nick.'/'.$repo.'/commits');
              $response =$request->getBody();
              $response_as_array = ((json_decode($response,true)));
              $last_commit_sha = ($response_as_array[0]["sha"]);
              $last_commit_url = ($response_as_array[0]["html_url"]);
              echo $last_commit_sha.PHP_EOL.$last_commit_url.PHP_EOL;
              break;
          case "Bitbucket":
              $client = new Client();
              $question = new Question('Insert your workspace : ');
              $question1 = new Question('Insert repo name : ');
              $workspace = $helper->ask($input,$output,$question);
              $repoSlug = $helper->ask($input,$output,$question1);
              $request1 = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$workspace.'/'.$repoSlug.'/commits');
              $response1 =$request1->getBody();
              $response_as_array1 = ((json_decode($response1,true)));
              $last_commit_sha1 = ($response_as_array1["values"][0]["hash"]);
              $last_commit_url1 = ($response_as_array1["values"][0]["repository"]["links"]["html"]["href"]);
              echo $last_commit_sha1.PHP_EOL.$last_commit_url1.PHP_EOL;
              break;

      }

      return Command::SUCCESS;
     }
}

