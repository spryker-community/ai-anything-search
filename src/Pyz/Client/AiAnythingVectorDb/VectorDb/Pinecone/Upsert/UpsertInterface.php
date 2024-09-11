<?php

declare(strict_types=1);

namespace Pyz\Client\AiAnythingVectorDb\VectorDb\Pinecone\Upsert;

interface UpsertInterface
{
    public function upsert(string $id, array $data, array $metadata): int;
}
