<?php

namespace KubaEnd\Platforms\Bitbucket;


use RuntimeException;

class Platform extends BitbucketClient
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

        if (! isset($response["values"][0]["hash"])) {
            throw new RuntimeException(
                sprintf('Cannot get last commit SHA from  [%s/%s] repository.', $username, $repositoryName)
            );
        }


        return $response["values"][0]["hash"];
    }
}

