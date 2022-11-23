# HTTP API Client Bundle

## Required configuration example

```yaml
ApiClient\Service\ApiClient:
    class: ApiClient\Service\ApiClient
    arguments:
        $httpClient: '@GuzzleHttp\ClientInterface'

ApiClient\Service\ApiClientInterface: '@ApiClient\Service\ApiClient'
```

## Usage example

```php
private \ApiClient\Service\ApiClientInterface $apiClient;

public function __construct(\ApiClient\Service\ApiClientInterface $apiClient)
{
    $this->apiClient = $apiClient;
}

public function sendGet()
{
    // curl --location --request GET 'http://example.org/endpoint?some=data'
    $response = $this->apiClient
        ->makeGetClient('http://example.org/endpoint')
        ->withResponseAs(Example\EndpoindDTO::class)
        ->withRequest(['some' => 'data',])
        ->send();

    /** @var int $responseCode */
    $responseCode = $response->getCode();
    /** @var array<string, string> $responseHeaders */
    $responseHeaders = $response->getHeaders();
    /** @var Example\EndpoindDTO $responseDTO */
    $responseDTO = $response->getResponse();
    return;
}

public function sendPost()
{
    // curl --location --request POST 'http://example.org/endpoint' --header 'Content-Type: application/json' --data-raw '{"some": "data"}'
    $response = $this->apiClient
        ->makePostClient('http://example.org/endpoint')
        ->withResponseAs(Example\EndpoindDTO::class)
        ->withRequest(['some' => 'data',])
        ->send();

    /** @var int $responseCode */
    $responseCode = $response->getCode();
    /** @var array<string, string> $responseHeaders */
    $responseHeaders = $response->getHeaders();
    /** @var Example\EndpoindDTO $responseDTO */
    $responseDTO = $response->getResponse();
    return;
}
```

## Disclaimer

All information and source code are provided AS-IS, without express or implied warranties.
Use of the source code or parts of it is at your sole discretion and risk.
Citymobil LLC takes reasonable measures to ensure the relevance of the information posted in this repository, but it does not assume responsibility for maintaining or updating this repository or its parts outside the framework established by the company independently and without notifying third parties.


Вся информация и исходный код предоставляются в исходном виде, без явно выраженных или подразумеваемых гарантий. Использование исходного кода или его части осуществляются исключительно по вашему усмотрению и на ваш риск. Компания ООО "Ситимобил" принимает разумные меры для обеспечения актуальности информации, размещенной в данном репозитории, но она не принимает на себя ответственности за поддержку или актуализацию данного репозитория или его частей вне рамок, устанавливаемых компанией самостоятельно и без уведомления третьих лиц.
