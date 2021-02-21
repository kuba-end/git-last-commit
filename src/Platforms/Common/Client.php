<?php

namespace KubaEnd\Platforms\Common;

use GuzzleHttp\Client as HttpClient;
use KubaEnd\Platforms\Interfaces\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
    /**
     * Http client instance.
     *
     * @var HttpClient
     */
    protected HttpClient $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new HttpClient([
            'verify' => false
        ]);
    }

    /**
     * Decode response.
     *
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function decode(ResponseInterface $response): array
    {
        $body = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                sprintf('Cannot decode response.')
            );
        }

        return $body;
    }

    /**
     * Make request using HTTP client.
     *
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return array
     */
    public function request(string $method, $uri = '', array $options = []): array
    {
        return $this->decode(
            $this->httpClient->request($method, $uri, $options)
        );
    }
}
