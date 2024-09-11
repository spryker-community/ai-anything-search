<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business\Facade;

use Pyz\Zed\ProductVectorDbStorage\Business\ProductVectorDbStorageBusinessFactory;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method ProductVectorDbStorageBusinessFactory getFactory()
 */
class ProductVectorDbStorageFacade extends AbstractFacade implements ProductVectorDbStorageFacadeInterface 
{
    public function writeProductDataToVectorDb(array $transfers): void
    {
        return $this->getFactory()->createProductDataToVectorDbWriter()->write($transfers);
    }
}