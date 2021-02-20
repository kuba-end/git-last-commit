<?php

namespace KubaEnd\Controller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;
use KubaEnd\Commands\GitHubConnect;
use KubaEnd\Commands\BitbucketConnect;
use KubaEnd\Commands\GitLabConnect;

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
              $question = new Question('Insert your login : ');
              $question1 = new Question('Insert repo name : ');
              $nick = $helper->ask($input,$output,$question);
              $repo = $helper->ask($input,$output,$question1);
              $request = new GitHubConnect();
              $request->getLastCommitSha($nick,$repo);
              $request->showSha();
              break;
          case "Bitbucket":
              $question = new Question("Insert your workspace's name: ");
              $question1 = new Question('Insert repo name : ');
              $nick = $helper->ask($input,$output,$question);
              $repo = $helper->ask($input,$output,$question1);
              $request = new BitbucketConnect();
              $request->getLastCommitSha($nick,$repo);
              break;
          case "GitLab":
              $question = new Question("Insert your projects ID: ");
              $projectId = $helper->ask($input,$output,$question);
              $request = new GitLabConnect();
              $request ->connecting($projectId);
              break;
      }
      return Command::SUCCESS;
     }
}
