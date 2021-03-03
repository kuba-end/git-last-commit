<?php

namespace KubaEnd\Commands;

use KubaEnd\Common\Commands\AbstractCommand;
use KubaEnd\Platforms\GitHub\GithubClient;
use KubaEnd\Platforms\GitHub\Platform as GitHubPlatform;
use KubaEnd\Platforms\Bitbucket\Platform as BitbucketPlatform;
use KubaEnd\Platforms\Interfaces\PlatformInterface;

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
        $lastCommitSha = null;

        switch ($platform) {
            case self::GITHUB_PLATFORM:
                $login = $this->askQuestion('Insert your login: ');
                $repositoryName = $this->askQuestion('Insert your repo name: ');

                $githubPlatform = new GitHubPlatform(new GithubClient());
                $lastCommitSha = $githubPlatform->getLastCommitSha($login, $repositoryName);
                break;
            case self::BITBUCKET_PLATFORM:
                $login = $this->askQuestion('Insert your login: ');
                $repositoryName = $this->askQuestion('Insert your repo name: ');

                $githubPlatform = new BitbucketPlatform();
                $lastCommitSha = $githubPlatform->getLastCommitSha($login, $repositoryName);
                break;
            default:
                throw new \InvalidArgumentException('Invalid platform provided.');
        }

        $this->writeLine('');
        $this->writeLine(sprintf('%s platform selected.', $platform));
        $this->writeLine(sprintf('Last commit SHA is [%s]', $lastCommitSha));

        return self::SUCCESS;
    }

}
