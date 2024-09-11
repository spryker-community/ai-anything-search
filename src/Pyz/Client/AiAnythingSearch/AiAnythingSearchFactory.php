<?php

namespace Pyz\Client\AiAnythingSearch;

use Pyz\Client\AiAnythingSearch\Expander\UserIntentQueryExpander;
use Pyz\Client\AiAnythingSearch\Expander\UserIntentQueryExpanderInterface;
use Pyz\Client\Pinecone\PineconeClientInterface;
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
     * @return \Pyz\Client\Pinecone\PineconeClientInterface
     */
    protected function getPineconeClient(): PineconeClientInterface
    {
        return $this->getProvidedDependency(AiAnythingSearchDependencyProvider::PINECONE_CLIENT);
    }
}
