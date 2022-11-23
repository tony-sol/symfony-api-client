<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

use ApiClient\Exception;

class DeleteClient extends GetClient implements DeleteClientInterface
{
    protected string $method = 'DELETE';
}
