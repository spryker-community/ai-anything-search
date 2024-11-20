<?php

namespace Pyz\Zed\AiAnythingVectorDb\Persistence;

interface AiAnythingVectorDbRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return array
     */
    public function queryProductData(string $id): array;
}
