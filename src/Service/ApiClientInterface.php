<?php

declare(strict_types=1);

namespace ApiClient\Service;

use ApiClient\Api\Client;

interface ApiClientInterface
{
    /**
     * Make DELETE client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\DeleteClientInterface
     */
    public function makeDeleteClient(string $endpoint): Client\DeleteClientInterface;

    /**
     * Make GET client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\GetClientInterface
     */
    public function makeGetClient(string $endpoint): Client\GetClientInterface;

    /**
     * Make HEAD client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\HeadClientInterface
     */
    public function makeHeadClient(string $endpoint): Client\HeadClientInterface;

    /**
     * Make PATCH client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PatchClientInterface
     */
    public function makePatchClient(string $endpoint): Client\PatchClientInterface;

    /**
     * Make POST client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PostClientInterface
     */
    public function makePostClient(string $endpoint): Client\PostClientInterface;

    /**
     * Make PUT client
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PutClientInterface
     */
    public function makePutClient(string $endpoint): Client\PutClientInterface;
}
