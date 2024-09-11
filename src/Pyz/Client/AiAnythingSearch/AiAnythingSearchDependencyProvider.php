<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingSearch;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AiAnythingSearchDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const PINECONE_CLIENT = 'client.pinecone';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $this->addPineconeClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    protected function addPineconeClient(Container $container): void
    {
        $container->set(self::PINECONE_CLIENT, $container->getLocator()->pinecone()->client());
    }
}
