<?php


namespace Pyz\Zed\AiAnythingVectorDb\Business;

use Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface;
use Pyz\Zed\AiAnythingVectorDb\AiAnythingVectorDbDependencyProvider;
use Pyz\Zed\AiAnythingVectorDb\Business\Writer\ProductDataToVectorDbWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\AiAnythingVectorDb\Persistence\AiAnythingVectorDbRepository getRepository()
 */
class AiAnythingVectorDbBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\AiAnythingVectorDb\Business\Writer\ProductDataToVectorDbWriter
     */
    public function createProductDataToVectorDbWriter(): ProductDataToVectorDbWriter
    {
        return new ProductDataToVectorDbWriter(
            $this->getVectorDbClient(),
            $this->getRepository(),
        );
    }

    /**
     * @return \Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface
     */
    public function getVectorDbClient(): AiAnythingVectorDbClientInterface
    {
        return $this->getProvidedDependency(AiAnythingVectorDbDependencyProvider::PINECONE_CLIENT);
    }
}
