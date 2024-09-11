<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingEmbedding\Gemini;

use GuzzleHttp\ClientInterface;

class GeminiEmbeddingClient implements GeminiEmbeddingClientInterface
{
    private ClientInterface $client;
    private string $apiKey;
    private string $apiUrl;

    public function __construct(ClientInterface $client, string $apiKey, string $apiUrl)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    public function getEmbeddings(string $text): array
    {
        $data = [
            'model' => 'models/text-embedding-004',
            'content' => [
                'parts' => [
                    [
                        'text' => $text
                    ]
                ]
            ],
        ];

        $response = $this->client->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/text-embedding-004:embedContent?key='.$this->apiKey, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception(sprintf('Failed to get embedding: %s', $response->getBody()->getContents()));
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);

        return $responseBody['embedding']['values'];
    }
}
