<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

class ClientMetadata implements ClientMetadataInterface
{
    /**
     * ClientMetadata constructor
     *
     * @param string                  $method Client method to use.
     * @param string                  $uri    Client target URI.
     * @param \JsonSerializable|array $data   Client request data.
     */
    public function __construct(
        private string $method,
        private string $uri,
        private \JsonSerializable|array $data
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     *
     * @return \JsonSerializable|array
     */
    public function getData(): \JsonSerializable|array
    {
        return $this->data;
    }
}
