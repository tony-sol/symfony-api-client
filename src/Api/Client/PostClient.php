<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

use ApiClient\Exception;

class PostClient extends AbstractClient implements PostClientInterface
{
    protected string $method = 'POST';

    /**
     * Build the request JSON body with the specified parameters
     *
     * @psalm-suppress MixedReturnTypeCoercion
     * @psalm-suppress InvalidReturnType
     * @psalm-suppress InvalidReturnStatement
     *
     * @throws Exception\RequestBuildException
     *
     * @return array<string, array<string, string[]>>
     */
    protected function buildOptions(): array
    {
        $baseOptions = parent::buildOptions();
        if (empty($this->request)) {
            return $baseOptions;
        }
        try {
            $request = $this->delegate->getSerializer()->serialize($this->request, 'json');
        } catch (\Throwable $t) {
            $this->delegate->getLogger()->error("API Client error: {$t->getMessage()}");
            throw new Exception\RequestBuildException("Cannot build {$this->method} request body", $t);
        }
        return array_merge_recursive(
            $baseOptions,
            [
                'headers' => ['Content-Type' => 'application/json'],
                'body'    => $request,
            ]
        );
    }
}
