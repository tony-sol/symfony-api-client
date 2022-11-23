<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

use ApiClient\Exception;

class GetClient extends AbstractClient implements GetClientInterface
{
    protected string $method = 'GET';

    /**
     * Build the request url with the specified parameters
     *
     * @throws Exception\RequestBuildException
     *
     * @return string
     */
    protected function buildUri(): string
    {
        $baseUri = parent::buildUri();
        if (empty($this->request)) {
            return $baseUri;
        }
        try {
            $data  = (array)$this->delegate->getNormalizer()->normalize($this->request);
            $query = str_contains($baseUri, '?') ? '&' : '?';
            /** @psalm-suppress MixedArgumentTypeCoercion */
            $query .= array_is_list($data)
                ? implode('&', $data)
                : http_build_query($data);
        } catch (\Throwable $t) {
            $this->delegate->getLogger()->error("API Client error: {$t->getMessage()}");
            throw new Exception\RequestBuildException('Cannot build GET query string', $t);
        }
        return "{$baseUri}{$query}";
    }
}
