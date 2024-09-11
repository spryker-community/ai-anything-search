<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Pinecone;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\OmsDependencyProvider as SprykerOmsDependencyProvider;

class PineconeDependencyProvider extends SprykerOmsDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PINECONE = 'CLIENT_PINECONE';


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container->set(static::CLIENT_PINECONE, function (Container $container) {
            return $container->getLocator()->pinecone()->client();
        });

        return $container;
    }
}
