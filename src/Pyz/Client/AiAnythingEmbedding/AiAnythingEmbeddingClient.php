<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingEmbedding;

use GuzzleHttp\ClientInterface;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingFactory getFactory()
 */
class AiAnythingEmbeddingClient extends AbstractClient implements AiAnythingEmbeddingClientInterface
{
    public function getEmbeddings(string $text): array
    {
       return $this->getFactory()
            ->getGeminiEmbeddingClient()
            ->getEmbeddings($text);
    }
}
