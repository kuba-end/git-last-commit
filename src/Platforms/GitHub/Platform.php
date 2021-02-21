<?php

namespace KubaEnd\Platforms\GitHub;

use KubaEnd\Platforms\Common\AbstractPlatform;

class Platform extends AbstractPlatform
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
        $response = $this->client->request(
            'GET',
            sprintf('https://api.github.com/repos/%s/%s/commits', $username, $repositoryName)
        );

        if (! isset($response[0]['sha'])) {
            throw new \RuntimeException(
                sprintf('Cannot get last commit SHA from  [%s/%s] repository.', $username, $repositoryName)
            );
        }
        
        return $response[0]["sha"];
    }
}
