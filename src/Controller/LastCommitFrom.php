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
              $responseAsArray = ((json_decode($response,true)));
              $lastCommitSha = ($responseAsArray[0]["sha"]);
              $lastCommitUrl = ($responseAsArray[0]["html_url"]);
              echo "Sha of your last commit is: ".$lastCommitSha.PHP_EOL.$lastCommitUrl.PHP_EOL;
              break;
          case "Bitbucket":
              $client = new Client();
              $question = new Question("Insert your workspace's name: ");
              $question1 = new Question('Insert repo name : ');
              $workspace = $helper->ask($input,$output,$question);
              $repoSlug = $helper->ask($input,$output,$question1);
              $request1 = $client->request('GET', 'https://api.bitbucket.org/2.0/repositories/'.$workspace.'/'.$repoSlug.'/commits');
              $response1 =$request1->getBody();
              $responseAsArray1 = ((json_decode($response1,true)));
              $lastCommitSha1 = ($responseAsArray1["values"][0]["hash"]);
              $lastCommitUrl1 = ($responseAsArray1["values"][0]["repository"]["links"]["html"]["href"]);
              echo "Sha of your last commit is: ".$lastCommitSha1.PHP_EOL.$lastCommitUrl1.PHP_EOL;
              break;
          case "GitLab":
              $client = new Client();
              $question = new Question("Insert your projects ID: ");
              $projectId = $helper->ask($input,$output,$question);
              $request2 = $client->request('GET','https://gitlab.com/api/v4/projects/'.$projectId.'/repository/commits');
              $response2 = $request2->getBody();
              $responseAsArray2 = ((json_decode($response2,true)));
              $lastCommitSha2 = ($responseAsArray2[0]["id"]);
              $lastCommitUrl2 = ($responseAsArray2[0]["web_url"]);
              echo "Sha of your last commit is: ".$lastCommitSha2.PHP_EOL.$lastCommitUrl2.PHP_EOL;
              break;

      }

      return Command::SUCCESS;
     }
}

