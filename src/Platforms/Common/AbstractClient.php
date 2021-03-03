<?php


namespace KubaEnd\Platforms\Common;


use GuzzleHttp\Client as HttpClient;
use KubaEnd\Platforms\Interfaces\AbstractClientInterface;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract class AbstractClient implements AbstractClientInterface
{
    protected $client;


    public function __construct(){
        $this->client= new HttpClient([
            'verify' => false
        ]);
    }

    /**
     * Decoding method used by all clients to decode JSON response to array
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function decode(ResponseInterface $response): array
    {
        $body = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException(
                sprintf('Cannot decode response.')
            );
        }

        return $body;
    }
}