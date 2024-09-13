<?php

namespace Pyz\Client\AiAnythingSearch;

use Pyz\Client\AiAnythingSearch\Expander\UserIntentQueryExpander;
use Pyz\Client\AiAnythingSearch\Expander\UserIntentQueryExpanderInterface;
use Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class AiAnythingSearchFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\AiAnythingSearch\Expander\UserIntentQueryExpanderInterface
     */
    public function createQueryExpander(): UserIntentQueryExpanderInterface
    {
        return new UserIntentQueryExpander(
            $this->getPineconeClient()
        );
    }

    /**
     * @return \Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface
     */
    protected function getPineconeClient(): AiAnythingVectorDbClientInterface
    {
        return $this->getProvidedDependency(AiAnythingSearchDependencyProvider::AI_ANYTHING_VECTOR_DB_CLIENT);
    }
}
