<?php

namespace Pyz\Zed\AiAnythingVectorDb;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AiAnythingVectorDbDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PINECONE_CLIENT = 'PINECONE_CLIENT';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addVectorDbClient($container);

        return $container;
    }

    public function addVectorDbClient($container): Container
    {
        $container->set(static::PINECONE_CLIENT, function (Container $container) {
            return $container->getLocator()->aiAnythingVectorDb()->client();
        });

        return $container;
    }
}
