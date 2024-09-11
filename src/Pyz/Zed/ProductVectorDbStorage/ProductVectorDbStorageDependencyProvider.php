<?php

namespace Pyz\Zed\ProductVectorDbStorage;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductVectorDbStorageDependencyProvider extends AbstractBundleDependencyProvider
{

    public const PINECONE_CLIENT = 'PINECONE_CLIENT';
    public function provideBusinessLayerDependencies(Container $container): Container
    {   
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addPineconeClient($container);

        return $container;
    }

    public function addPineconeClient($container): Container {
        
        $container->set(static::PINECONE_CLIENT, function (Container $container) {
            return $container->getLocator()->pinecone()->client();
        });

        return $container;
    }
}