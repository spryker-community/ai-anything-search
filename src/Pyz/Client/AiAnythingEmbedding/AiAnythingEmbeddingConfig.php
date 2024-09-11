<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\AiAnythingEmbedding;

use Pyz\Shared\AiAnythingEmbedding\AiAnythingEmbeddingConstants;
use Spryker\Shared\Kernel\AbstractSharedConfig;

class AiAnythingEmbeddingConfig extends AbstractSharedConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->get(AiAnythingEmbeddingConstants::GEMINI_API_KEY);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->get(AiAnythingEmbeddingConstants::GEMINI_API_URL);
    }
}
