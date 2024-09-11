<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingClientInterface;
use Pyz\Client\Pinecone\Query\Query;
use Pyz\Client\Pinecone\Query\QueryInterface;
use Pyz\Client\Pinecone\Upsert\Upsert;
use Pyz\Client\Pinecone\Upsert\UpsertInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\Pinecone\PineconeConfig getConfig()
 */
class PineconeFactory extends AbstractFactory
{
    public function createQuery(): QueryInterface
    {
        return new Query(
            $this->createHttpClient(),
            $this->getEmbeddingClient(),
            $this->getConfig()->getApiKey(),
            $this->getConfig()->getApiVersion(),
            $this->getConfig()->getApiUrl(),
        );
    }

    public function createUpsert(): UpsertInterface
    {
        return new Upsert(
            $this->createHttpClient(),
            $this->getEmbeddingClient(),
            $this->getConfig()->getApiKey(),
            $this->getConfig()->getApiVersion(),
            $this->getConfig()->getApiUrl(),
        );
    }

    protected function createHttpClient(): ClientInterface
    {
        return new Client();
    }

    public function getEmbeddingClient(): AiAnythingEmbeddingClientInterface
    {
        return $this->getProvidedDependency(PineconeDependencyProvider::CLIENT_EMBEDDING);
    }
}
