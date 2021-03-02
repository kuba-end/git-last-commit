<?php


namespace KubaEnd\Platforms\Bitbucket;


use KubaEnd\Platforms\Common\AbstractPlatform;
use KubaEnd\Platforms\Interfaces\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class BitbucketClient extends AbstractPlatform implements ClientInterface
{
    /**
     * @var string
     */
    protected string $baseUrl;

    public function decode(ResponseInterface $response): array
    {
        $body=json_decode($response->getBody(),true);
        if (json_last_error()!==JSON_ERROR_NONE){
            throw new RuntimeException(
                sprintf('Cannot decode response.')
            );
        }
        return $body;
    }
    public function request(string $username, string $repositoryName): array
    {
        $method='GET';
        $this->baseUrl="https://api.bitbucket.org/2.0";
        $username='/repositories/'.$username.'/';
        $repositoryName=$repositoryName.'/commits';
        $uri=$this->baseUrl.$username.$repositoryName;
        return $this->client->request($method,$uri);

    }
}