<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Pinecone\Communication;

use Pyz\Client\Pinecone\PineconeClientInterface;
use Pyz\Zed\Pinecone\PineconeDependencyProvider;
use Spryker\Zed\Oms\Communication\OmsCommunicationFactory as SprykerOmsCommunicationFactory;

class PineconeCommunicationFactory extends SprykerOmsCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Translator\Business\TranslatorFacadeInterface
     */
    public function getPineconeClient(): PineconeClientInterface
    {
        return $this->getProvidedDependency(PineconeDependencyProvider::CLIENT_PINECONE);
    }
}
