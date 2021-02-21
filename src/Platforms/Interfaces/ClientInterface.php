<?php

namespace KubaEnd\Platforms\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * Decode response.
     *
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function decode(ResponseInterface $response): array;

    /**
     * Make request using HTTP client.
     *
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return array
     */
    public function request(string $method, $uri = '', array $options = []): array;
}
