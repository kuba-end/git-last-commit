<?php

namespace KubaEnd\Platforms\Common;

use KubaEnd\Platforms\Interfaces\ClientInterface;
use KubaEnd\Platforms\Interfaces\PlatformInterface;

abstract class AbstractPlatform implements PlatformInterface
{
    /**
     * Platform client instance.
     *
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * Platform constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get platform client.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Set platform client.
     *
     * @param ClientInterface $client
     *
     * @return void
     */
    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }
}
