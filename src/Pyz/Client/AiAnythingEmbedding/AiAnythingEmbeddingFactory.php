<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\AiAnythingEmbedding;

use GuzzleHttp\ClientInterface;
use Pyz\Client\AiAnythingEmbedding\Gemini\GeminiEmbeddingClient;
use Pyz\Client\AiAnythingEmbedding\Gemini\GeminiEmbeddingClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\AiAnythingEmbedding\AiAnythingEmbeddingConfig getConfig()
 */
class AiAnythingEmbeddingFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\AiAnythingEmbedding\Gemini\GeminiEmbeddingClientInterface
     */
    public function getGeminiEmbeddingClient(): GeminiEmbeddingClientInterface
    {
        return new GeminiEmbeddingClient(
            $this->getGuzlleHttpClient(),
            $this->getConfig()->getApiKey(),
            $this->getConfig()->getApiUrl()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getGuzlleHttpClient(): ClientInterface
    {
        return $this->getProvidedDependency(AiAnythingEmbeddingDependencyProvider::SERVICE_GUZZLE);
    }
}
