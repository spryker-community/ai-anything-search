<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone;

interface PineconeClientInterface
{
    public function query(array $vector, int $topK, bool $includeValues): array;

    public function upsert(array $vectors): int;
}
