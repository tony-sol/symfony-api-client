<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

class HeadClient extends GetClient implements HeadClientInterface
{
    protected string $method = 'HEAD';
}
