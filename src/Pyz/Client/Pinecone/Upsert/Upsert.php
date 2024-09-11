<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Upsert;

use Exception;
use GuzzleHttp\ClientInterface;

class Upsert implements UpsertInterface
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function upsert(array $vectors): int
    {
        $response = $this->httpClient->request('POST', 'https://gemini-kwgdoea.svc.aped-4627-b74a.pinecone.io/vectors/upsert', [
            'headers' => [
                'API-Key' => '2f186b01-6252-4084-9d81-c2423dd98b77',
                'X-Pinecone-API-Version' => '2024-07',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($vectors)
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(sprintf('Failed to upsert vectors: %s', $response->getBody()->getContents()));
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);

        return $responseBody['upsertedCount'];
    }
}
