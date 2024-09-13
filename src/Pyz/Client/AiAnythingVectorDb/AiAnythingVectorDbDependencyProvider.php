<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingVectorDb;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AiAnythingVectorDbDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_EMBEDDING = 'CLIENT_EMBEDDING';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addEmbeddingClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addEmbeddingClient(Container $container)
    {
        $container->set(static::CLIENT_EMBEDDING, function (Container $container) {
            return $container->getLocator()->aiAnythingEmbedding()->client();
        });

        return $container;
    }
}
