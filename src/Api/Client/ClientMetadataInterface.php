<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

interface ClientMetadataInterface
{
    /**
     * Get client method
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Get client endpoint
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Get client request
     *
     * @return \JsonSerializable|array
     */
    public function getData(): \JsonSerializable|array;
}
