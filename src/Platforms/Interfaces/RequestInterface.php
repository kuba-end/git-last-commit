<?php

namespace KubaEnd\Platforms\Interfaces;

interface RequestInterface
{
    public function request(string $username, string $repositoryName): array;

}
