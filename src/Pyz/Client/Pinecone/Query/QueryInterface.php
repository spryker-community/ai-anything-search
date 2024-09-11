<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Query;

interface QueryInterface
{
    public function query(string $text, int $limit = 30, bool $includeValues = true): array;
}
