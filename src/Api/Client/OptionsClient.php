<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

class OptionsClient extends GetClient implements OptionsClientInterface
{
    protected string $method = 'OPTIONS';
}
