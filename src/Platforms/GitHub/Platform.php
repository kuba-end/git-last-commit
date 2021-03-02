<?php

namespace KubaEnd\Platforms\GitHub;


use RuntimeException;

class Platform extends GithubClient
{
    /**
     * Get last commit SHA from Github via username and repository name.
     *
     * @param string $username
     * @param string $repositoryName
     *
     * @return string
     */
    public function getLastCommitSha(string $username, string $repositoryName): string
    {
        $response = $this->request($username, $repositoryName);

        if (! isset($response[0]['sha'])) {
            throw new RuntimeException(
                sprintf('Cannot get last commit SHA from  [%s/%s] repository.', $username, $repositoryName)
            );
        }


        return $response[0]["sha"];
    }
}
$test=new Platform();
var_dump($test->getLastCommitSha('kuba-end','git-last-repo'));
