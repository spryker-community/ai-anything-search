<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone;

use GuzzleHttp\Client;

/**
 * @method \Pyz\Client\Pinecone\PineconeFactory getFactory()
 */
class PineconeClient implements PineconeClientInterface
{
    public function query(array $vector, int $topK, bool $includeValues): array
    {
        return $this->getFactory()
            ->createQuery()
            ->query($vector, $topK, $includeValues);
    }

    public function upsert(array $vectors): int
    {
        return $this->getFactory()
            ->createUpsert()
            ->upsert($vectors);
    }
}
