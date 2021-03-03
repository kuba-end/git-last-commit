<?php


namespace KubaEnd\Platforms\GitLab;


use KubaEnd\Platforms\Interfaces\RequestInterface;
use RuntimeException;

class Platform
{
    private RequestInterface $response;

    public function __construct(RequestInterface $response){
        $this->response=$response;
    }
    /**
     * Get last commit SHA from Github via user and repository names.
     *
     * @param string $username
     * @param string $repositoryName
     *
     * @return string
     */
    public function getLastCommitSha(string $username, string $repositoryName): string
    {
        $response = $this->response->request($username, $repositoryName);

        if (! isset($response[0]['id'])) {
            throw new RuntimeException(
                sprintf('Cannot get last commit SHA from  [%s/%s] repository.', $username, $repositoryName)
            );
        }
        return $response[0]["id"];
    }
}
