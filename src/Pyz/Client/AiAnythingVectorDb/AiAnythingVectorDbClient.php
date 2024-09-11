<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingVectorDb;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbFactory getFactory()
 */
class AiAnythingVectorDbClient extends AbstractClient implements AiAnythingVectorDbClientInterface
{
    /**
     * @inheritDoc
     */
    public function query(string $text, int $limit = 30, bool $includeValues = true): array
    {
        return $this->getFactory()->createVectorDb()->query($text, $limit, $includeValues);
    }

    /**
     * @inheritDoc
     */
    public function upsert(string $id, array $data, array $metadata): int
    {
        return $this->getFactory()->createVectorDb()->upsert($id, $data, $metadata);
    }
}
