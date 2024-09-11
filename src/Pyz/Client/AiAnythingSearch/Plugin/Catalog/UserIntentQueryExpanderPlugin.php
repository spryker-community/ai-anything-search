<?php

namespace Pyz\Client\AiAnythingSearch\Plugin\Catalog;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \Pyz\Client\AiAnythingSearch\AiAnythingSearchClientInterface getClient()
 */
class UserIntentQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @inheritDoc
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = [])
    {
        return $this->getClient()->expandQueryWithUserIntent($searchQuery, $requestParameters);
    }
}
