<?php

namespace Pyz\Client\AiAnythingVectorDb\VectorDb;

interface VectorDbInterface
{
    /**
     * @param string $text
     * @param int $limit
     * @param bool $includeValues
     *
     * @return array
     */
    public function query(string $text, int $limit = 30, bool $includeValues = true): array;

    /**
     * @param string $id
     * @param array $data
     * @param array $metadata
     *
     * @return int
     */
    public function upsert(string $id, array $data, array $metadata): int;
}
