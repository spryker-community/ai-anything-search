<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone\Upsert;

interface UpsertInterface
{
    public function upsert(array $vectors): int;
}
