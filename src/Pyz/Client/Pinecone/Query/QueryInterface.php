<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Query;

interface QueryInterface
{
    public function query(array $vector, int $topK, bool $includeValues): array;
}
