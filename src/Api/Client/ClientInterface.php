<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

use ApiClient\Api\Response\ResponseInterface;
use ApiClient\Exception;

interface ClientInterface
{
    /**
     * Get client getMetadata
     *
     * @return ClientMetadataInterface
     */
    public function getMetadata(): ClientMetadataInterface;

    /**
     * Set client headers
     *
     * @param array<string, string[]> $headers Client headers.
     *
     * @return ClientInterface
     */
    public function withHeaders(array $headers): ClientInterface;

    /**
     * Set client request
     *
     * @param \JsonSerializable|array $request Client request.
     *
     * @return ClientInterface
     */
    public function withRequest(\JsonSerializable|array $request): ClientInterface;

    /**
     * Set client response as
     *
     * @param class-string $object Class of the client response.
     *
     * @return ClientInterface
     */
    public function withResponseAs(string $object): ClientInterface;

    /**
     * Send client request
     *
     * @throws Exception\BaseException
     *
     * @return ResponseInterface
     */
    public function send(): ResponseInterface;
}
