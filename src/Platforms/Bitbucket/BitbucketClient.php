<?php


namespace KubaEnd\Platforms\Bitbucket;


use KubaEnd\Platforms\Common\AbstractClient;
use KubaEnd\Platforms\Interfaces\RequestInterface;


class BitbucketClient extends AbstractClient implements RequestInterface
{

    const BITBUCKET_BASE_URI="https://api.bitbucket.org/2.0";

    /**
     * request to Bitbucket API, next decode JSON response
     * @param string $username
     * @param string $repositoryName
     * @return array
     * @throws
     */
    public function request(string $username, string $repositoryName): array
    {
        $method='GET';
        $username='/repositories/'.$username.'/';
        $repositoryName=$repositoryName.'/commits';
        $uri=self::BITBUCKET_BASE_URI.$username.$repositoryName;
        return $this->decode($this->client->request($method,$uri));

    }
}