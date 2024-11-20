<?php

namespace Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone;

use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Query\QueryInterface;
use Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert\UpsertInterface;
use Pyz\Client\AiAnythingVectorDb\VectorDb\VectorDbInterface;

class PinceconeVectorDb implements VectorDbInterface
{
    /**
     * @param \Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Query\QueryInterface $query
     * @param \Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert\UpsertInterface $upsert
     */
    public function __construct(
        protected readonly QueryInterface $query,
        protected readonly UpsertInterface $upsert,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function query(string $text, int $limit = 30, bool $includeValues = true): array
    {
        return $this->query->query($text, $limit, $includeValues);
    }

    /**
     * @inheritDoc
     */
    public function upsert(string $id, array $data, array $metadata): int
    {
        return $this->upsert->upsert($id, $data, $metadata);
    }
}
