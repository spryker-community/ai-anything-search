<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingVectorDb;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingClientInterface;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\PinceconeVectorDb;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Query\Query;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Query\QueryInterface;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert\Upsert;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert\UpsertInterface;
use Pyz\Client\AiAnythingVectorDb\VectorDb\VectorDbInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbConfig getConfig()
 */
class AiAnythingVectorDbFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\AiAnythingVectorDb\VectorDb\VectorDbInterface
     */
    public function createVectorDb(): VectorDbInterface
    {
        return new PinceconeVectorDb(
            $this->createPineconeQuery(),
            $this->createPineconeUpsert(),
        );
    }

    /**
     * @return \Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Query\QueryInterface
     */
    protected function createPineconeQuery(): QueryInterface
    {
        return new Query(
            $this->createHttpClient(),
            $this->getEmbeddingClient(),
            $this->getConfig()->getApiKey(),
            $this->getConfig()->getApiVersion(),
            $this->getConfig()->getApiUrl(),
        );
    }

    /**
     * @return \Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert\UpsertInterface
     */
    protected function createPineconeUpsert(): UpsertInterface
    {
        return new Upsert(
            $this->createHttpClient(),
            $this->getEmbeddingClient(),
            $this->getConfig()->getApiKey(),
            $this->getConfig()->getApiVersion(),
            $this->getConfig()->getApiUrl(),
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): ClientInterface
    {
        return new Client();
    }

    /**
     * @return \Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingClientInterface
     */
    protected function getEmbeddingClient(): AiAnythingEmbeddingClientInterface
    {
        return $this->getProvidedDependency(AiAnythingVectorDbDependencyProvider::CLIENT_EMBEDDING);
    }

}
