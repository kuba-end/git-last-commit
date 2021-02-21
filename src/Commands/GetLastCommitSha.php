<?php

namespace KubaEnd\Commands;

use KubaEnd\Common\Commands\AbstractCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;

class GetLastCommitSha extends AbstractCommand
{
    const GITHUB_PLATFORM = 'GitHub';
    const BITBUCKET_PLATFORM = 'Bitbucket';
    const GITLAB_PLATFORM = 'GitLab';

    const AVAILABLE_PLATFORMS = [
        self::GITHUB_PLATFORM,
        self::BITBUCKET_PLATFORM,
        self::GITLAB_PLATFORM,
    ];

    protected static $defaultName = "last-commit:sha";

    protected function askAboutPlatform(): string
    {
        return $this->askChoiceQuestion(
            "Please select platform from which you want to get information about your last commit (default Github)",
            self::AVAILABLE_PLATFORMS,
            0
        );
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Show info about your last commit SHA')
            ->setHelp('Type your login in first input area and name of repository you want to get the result from');
    }

    public function handle(): int
    {
        $platform = $this->askAboutPlatform();
        $this->writeLine(sprintf('%s platform selected.', $platform));

        switch ($platform) {
            case self::GITHUB_PLATFORM:
                $login = $this->askQuestion('Insert your login:');
                $repositoryName = $this->askQuestion('Insert your repo name:');

                $request = new GitHubConnect();
                $request->getLastCommitSha($login, $repositoryName);
                $request->showSha();
                break;
            case self::BITBUCKET_PLATFORM:
                $question = new Question("Insert your workspace's name: ");
                $question1 = new Question('Insert repo name : ');
                $login = $helper->ask($input, $output, $question);
                $repositoryName = $helper->ask($input, $output, $question1);
                $request = new BitbucketConnect();
                $request->getLastCommitSha($login, $repositoryName);
                break;
            case self::GITLAB_PLATFORM:
                $question = new Question("Insert your projects ID: ");
                $projectId = $helper->ask($input, $output, $question);
                $request = new GitLabConnect();
                $request->connecting($projectId);
                break;
        }

        return Command::SUCCESS;
    }

}
