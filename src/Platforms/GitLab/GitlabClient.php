<?php


namespace KubaEnd\Platforms\GitLab;


use KubaEnd\Platforms\Common\AbstractClient;
use KubaEnd\Platforms\Interfaces\RequestInterface;

class GitlabClient extends AbstractClient implements RequestInterface
{

    const GITLAB_BASE_URI="https://gitlab.com/api/v4";
    const USERNAME="";
    public function request(string $username, string $repositoryName): array
    {
        $method='GET';
        $repositoryName='/projects/'.$repositoryName.'/repository/commits';
        $uri=self::GITLAB_BASE_URI.$repositoryName;
        return $this->decode($this->client->request($method,$uri));

    }
}