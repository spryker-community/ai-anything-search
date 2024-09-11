<?php


namespace Pyz\Zed\ProductVectorDbStorage\Business;

use Pyz\Client\Pinecone\PineconeClientInterface;
use Pyz\Zed\ProductVectorDbStorage\Business\Writer\ProductDataToVectorDbWriter;
use Pyz\Zed\ProductVectorDbStorage\ProductVectorDbStorageDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\ProductVectorDbStorage\Persistence\ProductVectorDbStorageRepository getRepository()
 */
class ProductVectorDbStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\ProductVectorDbStorage\Business\Writer\ProductDataToVectorDbWriter
     */
    public function createProductDataToVectorDbWriter(): ProductDataToVectorDbWriter
    {
        return new ProductDataToVectorDbWriter(
            $this->getVectorDbClient(),
            $this->getRepository(),
        );
    }

    /**
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @return \Pyz\Client\Pinecone\PineconeClientInterface
     */
    public function getVectorDbClient(): PineconeClientInterface
    {
        return $this->getProvidedDependency(ProductVectorDbStorageDependencyProvider::PINECONE_CLIENT);
    }
}
