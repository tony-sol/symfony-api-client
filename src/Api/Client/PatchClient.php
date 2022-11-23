<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

class PatchClient extends PostClient implements PatchClientInterface
{
    protected string $method = 'PATCH';
}
