<?php

namespace KubaEnd\Platforms\Interfaces;

interface PlatformInterface
{
    /**
     * Get platform client.
     *
     * @return mixed
     */
    public function getClient(): ClientInterface;

    /**
     * Set platform client.
     *
     * @param $client
     *
     * @return mixed
     */
    public function setClient(ClientInterface $client): void;
}
