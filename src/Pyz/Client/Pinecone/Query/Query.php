<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Query;

use Exception;
use GuzzleHttp\ClientInterface;

class Query implements QueryInterface
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function query(array $vector, int $topK, bool $includeValues): array
    {
        $requestBody = [
            'vector' => $vector,
            'topK' => $topK,
            'includeValues' => $includeValues,
        ];

        $response = $this->httpClient->request('POST', 'https://gemini-kwgdoea.svc.aped-4627-b74a.pinecone.io/query', [
            'headers' => [
                'API-Key' => '2f186b01-6252-4084-9d81-c2423dd98b77',
                'X-Pinecone-API-Version' => '2024-07',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($requestBody)
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(sprintf('Failed to query: %s', $response->getBody()->getContents()));
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
