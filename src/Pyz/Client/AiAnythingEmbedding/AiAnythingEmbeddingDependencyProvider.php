<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\AiAnythingEmbedding;

use GuzzleHttp\Client;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * @method \Spryker\Client\Customer\CustomerConfig getConfig()
 */
class AiAnythingEmbeddingDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_GUZZLE = 'SERVICE_GUZZLE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addGuzzleHttpClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addGuzzleHttpClient(Container $container)
    {
        $container->set(static::SERVICE_GUZZLE, function () {
            return new Client();
        });

        return $container;
    }
}
