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
    public const AI_ANYTHING_VECTOR_DB_CLIENT = 'client.vector-db';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $this->addVectorDbClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    protected function addVectorDbClient(Container $container): void
    {
        $container->set(self::AI_ANYTHING_VECTOR_DB_CLIENT, $container->getLocator()->aiAnythingVectorDb()->client());
    }
}
