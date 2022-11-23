<?php

declare(strict_types=1);

namespace ApiClient\Api\Response;

class Response implements ResponseInterface
{
    /**
     * Response constructor
     *
     * @param array<array-key, array<array-key, string>> $headers    Response headers.
     * @param mixed                                      $response   Response data.
     * @param integer                                    $statusCode Response status code.
     */
    public function __construct(
        private array $headers,
        private mixed $response,
        private int $statusCode = 200
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @return array<array-key, array<array-key, string>>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }

    /**
     * Response JSON representation
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'headers' => $this->getHeaders(),
            'status'  => $this->getStatusCode(),
            'content' => $this->getResponse(),
        ];
    }

    /**
     * Response string representation
     *
     * @return string
     */
    public function __toString(): string
    {
        // phpcs:disable Generic.Files.LineLength.TooLong
        return json_encode($this, (JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION));
        // phpcs:enable
    }
}
