<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

class PutClient extends PostClient implements PutClientInterface
{
    protected string $method = 'PUT';
}
