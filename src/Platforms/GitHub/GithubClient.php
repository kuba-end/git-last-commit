<?php


namespace KubaEnd\Platforms\GitHub;



use KubaEnd\Platforms\Common\AbstractClient;
use KubaEnd\Platforms\Interfaces\RequestInterface;

class GithubClient extends AbstractClient implements RequestInterface
{
    const GITHUB_BASE_URI="https://api.github.com";

    /**
     * request for github return decoded response
     * @param string $username
     * @param string $repositoryName
     * @return array
     * @throws
     */
    public function request(string $username, string $repositoryName): array
    {
        $method='GET';
        $username='/repos/'.$username.'/';
        $repositoryName=$repositoryName.'/commits';
        $uri=self::GITHUB_BASE_URI.$username.$repositoryName;
        return $this->decode($this->client->request($method,$uri));
    }
}