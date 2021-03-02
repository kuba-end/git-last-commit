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
     * Make request using HTTP client
     *
     * @param string $username
     * @param string $repositoryName
     * @return array
     */
    public function request(string $username, string $repositoryName): array;
}
