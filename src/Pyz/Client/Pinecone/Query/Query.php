<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Query;

use Exception;
use GuzzleHttp\ClientInterface;
use Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingClientInterface;

class Query implements QueryInterface
{
    private ClientInterface $httpClient;
    private AiAnythingEmbeddingClientInterface $aiAnythingEmbeddingClient;

    public function __construct(
        ClientInterface $httpClient,
        AiAnythingEmbeddingClientInterface $aiAnythingEmbeddingClient
    ) {
        $this->httpClient = $httpClient;
        $this->aiAnythingEmbeddingClient = $aiAnythingEmbeddingClient;

    }

    public function query(string $text, int $limit = 30, bool $includeValues = true): array
    {
        $vector = $this->aiAnythingEmbeddingClient->getEmbeddings($text);
        $requestBody = [
            'vector' => $vector,
            'topK' => $limit,
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

        $products = [];
        $data = json_decode($response->getBody()->getContents(), true);

        if (!isset($data['matches'])) {
            return $products;
        }

        foreach ($data['matches'] as $product) {
            unset($product['values']);
            $products[] = $product;
        }

        return $products;
    }
}
