<?php

declare(strict_types=1);

namespace Pyz\Client\Pinecone;

use GuzzleHttp\Client;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\Pinecone\PineconeFactory getFactory()
 */
class PineconeClient  extends AbstractClient implements PineconeClientInterface
{
    public function query(string $text, int $limit = 30, bool $includeValues = true): array
    {
        return $this->getFactory()
            ->createQuery()
            ->query($text, $limit, $includeValues);
    }

    public function upsert(string $id, array $data, array $metadata): int
    {
        return $this->getFactory()
            ->createUpsert()
            ->upsert($id, $data, $metadata);
    }
}
