<?php


namespace KubaEnd\Platforms\GitHub;



use KubaEnd\Platforms\Common\AbstractPlatform;
use KubaEnd\Platforms\Interfaces\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class GithubClient extends AbstractPlatform implements ClientInterface
{
    /**
     * @var string $baseUrl
     */
    protected string $baseUrl;

    /**
     * @param ResponseInterface $response
     * @return array
     */
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

    /**
     * Create request only for GitHub platform, returning array with info about last commit
     * @param string $username
     * @param string $repositoryName
     * @return array
     */
    public function request(string $username, string $repositoryName): array
    {
        $method='GET';
        $this->baseUrl="https://api.github.com";
        $username='/repos/'.$username.'/';
        $repositoryName=$repositoryName.'/commits';
        $uri=$this->baseUrl.$username.$repositoryName;
        return $this->client->request($method,$uri);

    }
}