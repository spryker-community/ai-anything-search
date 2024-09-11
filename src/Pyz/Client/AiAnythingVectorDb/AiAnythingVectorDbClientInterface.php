<?php

namespace Pyz\Client\AiAnythingVectorDb;

interface AiAnythingVectorDbClientInterface
{
    /**
     * @param string $text
     * @param int $limit
     * @param bool $includeValues
     *
     * @return array<int>
     */
    public function query(string $text, int $limit = 30, bool $includeValues = true): array;

    /**
     * @param string $id
     * @param array<string> $data
     * @param array<string> $metadata
     *
     * @return int
     */
    public function upsert(string $id, array $data, array $metadata): int;
}
