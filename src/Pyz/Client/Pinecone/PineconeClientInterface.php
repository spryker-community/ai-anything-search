<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone;

interface PineconeClientInterface
{
    public function query(string $text, int $limit = 30, bool $includeValues = true): array;

    public function upsert(string $id, array $data, array $metadata): int;
}
