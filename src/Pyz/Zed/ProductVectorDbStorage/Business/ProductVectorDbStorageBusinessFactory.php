<?php


namespace Pyz\Zed\ProductVectorDbStorage\Business;

use Pyz\Client\Pinecone\PineconeClientInterface;
use Pyz\Zed\ProductVectorDbStorage\Business\Writer\ProductDataToVectorDbWriter;
use Pyz\Zed\ProductVectorDbStorage\ProductVectorDbStorageDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductVectorDbStorageBusinessFactory extends AbstractBusinessFactory 
{
    public function createProductDataToVectorDbWriter(): ProductDataToVectorDbWriter {
        return new ProductDataToVectorDbWriter(
            $this->getVectorDbClient()
        );
    }

    public function getVectorDbClient(): PineconeClientInterface
    {
        return $this->getProvidedDependency(ProductVectorDbStorageDependencyProvider::PINECONE_CLIENT);
    }
}