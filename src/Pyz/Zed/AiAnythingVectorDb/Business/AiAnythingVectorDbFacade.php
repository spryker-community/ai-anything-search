<?php

namespace Pyz\Zed\AiAnythingVectorDb\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method AiAnythingVectorDbBusinessFactory getFactory()
 */
class AiAnythingVectorDbFacade extends AbstractFacade implements AiAnythingVectorDbFacadeInterface
{
    public function writeProductDataToVectorDb(array $transfers): void
    {
        $this->getFactory()->createProductDataToVectorDbWriter()->write($transfers);
    }
}
