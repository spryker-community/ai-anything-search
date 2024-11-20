<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingVectorDb;

use Pyz\Shared\Pinecone\PineconeConstants;
use Spryker\Client\Kernel\AbstractBundleConfig;

class AiAnythingVectorDbConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->get(PineconeConstants::PINECONE_API_KEY);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->get(PineconeConstants::PINECONE_API_VERSION);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->get(PineconeConstants::PINECONE_INDEX_URL);
    }
}
