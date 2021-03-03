<?php


namespace KubaEnd\Platforms\Common;


use GuzzleHttp\Client as HttpClient;
use KubaEnd\Platforms\Interfaces\AbstractClientInterface;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient implements AbstractClientInterface
{
    protected $client;


    public function __construct(){
        $this->client= new HttpClient([
            'verify' => false
        ]);
    }
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
}