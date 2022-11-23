<?php

declare(strict_types=1);

namespace ApiClient\Service;

use ApiClient\Api\Delegate;
use ApiClient\Api\Client;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiClient implements ApiClientInterface
{
    private Delegate $delegate;

    /**
     * ApiClient constructor
     *
     * @param ClientInterface     $httpClient Http client instance.
     * @param SerializerInterface $serializer Serializer instance.
     * @param NormalizerInterface $normalizer Normalizer instance.
     * @param LoggerInterface     $logger     Logger instance.
     */
    public function __construct(
        ClientInterface $httpClient,
        SerializerInterface $serializer,
        NormalizerInterface $normalizer,
        LoggerInterface $logger
    ) {
        $this->delegate = new Delegate($httpClient, $serializer, $normalizer, $logger);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\DeleteClientInterface
     */
    public function makeDeleteClient(string $endpoint): Client\DeleteClientInterface
    {
        return new Client\DeleteClient($endpoint, $this->delegate);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\GetClientInterface
     */
    public function makeGetClient(string $endpoint): Client\GetClientInterface
    {
        return new Client\GetClient($endpoint, $this->delegate);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\HeadClientInterface
     */
    public function makeHeadClient(string $endpoint): Client\HeadClientInterface
    {
        return new Client\HeadClient($endpoint, $this->delegate);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PatchClientInterface
     */
    public function makePatchClient(string $endpoint): Client\PatchClientInterface
    {
        return new Client\PatchClient($endpoint, $this->delegate);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PostClientInterface
     */
    public function makePostClient(string $endpoint): Client\PostClientInterface
    {
        return new Client\PostClient($endpoint, $this->delegate);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $endpoint Target endpoint.
     *
     * @return Client\PutClientInterface
     */
    public function makePutClient(string $endpoint): Client\PutClientInterface
    {
        return new Client\PutClient($endpoint, $this->delegate);
    }
}
