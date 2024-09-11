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

    public function query(string $text, int $limit = 30, bool $includeValues = true): array
    {
        $vector = $this->aiAnythingEmbeddingClient->getEmbeddings($text);
        $requestBody = [
            'vector' => $vector,
            'topK' => $limit,
            'includeValues' => $includeValues,
        ];

        $response = $this->httpClient->request('POST', $this->apiUrl.'/query', [
            'headers' => [
                'API-Key' => $this->apiKey,
                'X-Pinecone-API-Version' => $this->apiVersion,
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
