<?php

declare(strict_types=1);

namespace ApiClient;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiClientBundle extends Bundle
{
    /**
     * Get ApiClient Bundle path
     *
     * @return string
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
