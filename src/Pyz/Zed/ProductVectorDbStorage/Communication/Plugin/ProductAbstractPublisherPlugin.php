<?php

namespace Pyz\Zed\ProductVectorDbStorage\Communication\Plugin;

use Pyz\Zed\ProductVectorDbStorage\Business\ProductVectorDbStorageFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method ProductVectorDbStorageFacadeInterface getFacade()
 */
class ProductAbstractPublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * {@inheritDoc}
     * -
     * - Publishes store data to Vector Database
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $transfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        try{
            $this->getFacade()->writeProductDataToVectorDb($transfers);
        } catch (\Throwable $exception){
            dd($exception);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_CREATE,
            ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE,
            ProductEvents::PRODUCT_ABSTRACT_PUBLISH,
        ];
    }
}
