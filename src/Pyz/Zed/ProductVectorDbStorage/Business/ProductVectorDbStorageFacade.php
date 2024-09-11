<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method ProductVectorDbStorageBusinessFactory getFactory()
 */
class ProductVectorDbStorageFacade extends AbstractFacade implements ProductVectorDbStorageFacadeInterface
{
    public function writeProductDataToVectorDb(array $transfers): void
    {
        $this->getFactory()->createProductDataToVectorDbWriter()->write($transfers);
    }
}
