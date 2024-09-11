<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Upsert;

use Exception;
use GuzzleHttp\ClientInterface;
use Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingClientInterface;

class Upsert implements UpsertInterface
{
    private ClientInterface $httpClient;
    private AiAnythingEmbeddingClientInterface $aiAnythingEmbeddingClient;
    private string $apiKey;
    private string $apiVersion;
    private string $apiUrl;

    public function __construct(
        ClientInterface $httpClient,
        AiAnythingEmbeddingClientInterface $aiAnythingEmbeddingClient,
        string $apiKey,
        string $apiVersion,
        string $apiUrl,
    ) {
        $this->httpClient = $httpClient;
        $this->aiAnythingEmbeddingClient = $aiAnythingEmbeddingClient;
        $this->apiKey = $apiKey;
        $this->apiVersion = $apiVersion;
        $this->apiUrl = $apiUrl;
    }

    public function upsert(string $id, array $data, array $metadata): int
    {
        $vector = $this->aiAnythingEmbeddingClient->getEmbeddings(implode(',', $data));
        $data =[
            'vectors' => [
                [
                    'id' => $id,
                    'values' => $vector,
                    'metadata' => $metadata,
                ]
            ]
        ];
        $response = $this->httpClient->request('POST', $this->apiUrl.'/vectors/upsert', [
            'headers' => [
                'API-Key' => $this->apiKey,
                'X-Pinecone-API-Version' => $this->apiVersion,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(sprintf('Failed to upsert vectors: %s', $response->getBody()->getContents()));
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);

        return $responseBody['upsertedCount'];
    }
}
