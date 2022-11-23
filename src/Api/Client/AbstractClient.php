<?php

declare(strict_types=1);

namespace ApiClient\Api\Client;

use Psr\Http\Message\ResponseInterface as PsrResponse;
use ApiClient\Api\Delegate;
use ApiClient\Api\Response;
use ApiClient\Exception;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
abstract class AbstractClient implements ClientInterface
{
    protected string $method;

    protected array $headers = [];

    protected \JsonSerializable|array $request = [];

    protected ?string $responseObject = null;

    /**
     * AbstractClient constructor
     *
     * @param string   $endpoint Target endpoint.
     * @param Delegate $delegate Delegate instance.
     */
    public function __construct(
        protected string $endpoint,
        protected Delegate $delegate
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @return ClientMetadataInterface
     */
    public function getMetadata(): ClientMetadataInterface
    {
        return new ClientMetadata($this->method, $this->endpoint, $this->request);
    }

    /**
     * {@inheritdoc}
     *
     * @param array<string, string[]> $headers Client headers.
     *
     * @return ClientInterface
     */
    public function withHeaders(array $headers): ClientInterface
    {
        $this->headers = array_merge_recursive($this->headers, $headers);
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param \JsonSerializable|array $request Client request.
     *
     * @return ClientInterface
     */
    public function withRequest(\JsonSerializable|array $request): ClientInterface
    {
        $this->request = $request;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param class-string $object Class of the client response.
     *
     * @return ClientInterface
     */
    public function withResponseAs(string $object): ClientInterface
    {
        $this->responseObject = $object;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception\BaseException
     *
     * @return Response\ResponseInterface
     */
    public function send(): Response\ResponseInterface
    {
        $rawResponse = $this->delegate->getHttpClient()->request(
            $this->method,
            $this->buildUri(),
            $this->buildOptions()
        );
        return $this->deserializeResponse($rawResponse);
    }

    /**
     * Build the URI for the request
     *
     * @return string
     */
    protected function buildUri(): string
    {
        return $this->endpoint;
    }

    /**
     * Build the options for the request
     *
     * @return array
     */
    protected function buildOptions(): array
    {
        return [
            'headers' => $this->headers,
        ];
    }

    /**
     * Deserialize the PsrResponse into a ResponseInterface
     *
     * @param PsrResponse $psrResponse The raw response from the client.
     *
     * @return Response\ResponseInterface
     *
     * @throws Exception\ResponseBuildException
     */
    protected function deserializeResponse(PsrResponse $psrResponse): Response\ResponseInterface
    {
        try {
            $responseContent = $psrResponse->getBody()->getContents();
            /** @psalm-suppress MixedAssignment */
            $response = empty($this->responseObject)
                ? $responseContent
                : $this->delegate->getSerializer()->deserialize(
                    $responseContent,
                    $this->responseObject,
                    $this->getResponseDeserializationFormat($psrResponse)
                );
        } catch (\Throwable $t) {
            $this->delegate->getLogger()->error("API Client error: {$t->getMessage()}");
            throw new Exception\ResponseBuildException('Cannot fetch and deserialize response content', $t);
        }
        return new Response\Response($psrResponse->getHeaders(), $response, $psrResponse->getStatusCode());
    }

    /**
     * Get PsrResponse deserialization format
     *
     * @param PsrResponse $psrResponse The raw response from the client.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function getResponseDeserializationFormat(PsrResponse $psrResponse): string
    {
        $responseContentType    = $psrResponse->getHeaderLine('content-type');
        $contentTypeToFormatMap = [
            'application/json'    => 'json',
            'application/x-json'  => 'json',
            'application/ld+json' => 'json',
            'text/xml'            => 'xml',
            'application/xml'     => 'xml',
            'application/x-xml'   => 'xml',
            'text/csv'            => 'csv',
        ];
        foreach ($contentTypeToFormatMap as $contentType => $format) {
            if (str_contains($responseContentType, $contentType)) {
                return $format;
            }
        }
        throw new \InvalidArgumentException("Unsuported Content-Type: {$responseContentType}");
    }
}
