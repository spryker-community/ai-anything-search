<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\Pinecone;

use GuzzleHttp\Client;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * @method \Spryker\Client\Customer\CustomerConfig getConfig()
 */
class PineconeDependencyProvider extends AbstractDependencyProvider
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
