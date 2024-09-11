<?php

declare(strict_types = 1);

namespace Pyz\Client\AiAnythingSearch;

use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \Pyz\Client\AiAnythingSearch\AiAnythingSearchFactory getFactory()
 */
class AiAnythingSearchClient extends AbstractClient implements AiAnythingSearchClientInterface
{
    /**
     * @inheritDoc
     */
    public function expandQueryWithUserIntent(QueryInterface $searchQuery, array $requestParameters): QueryInterface
    {
        return $this->getFactory()->createQueryExpander()->expandQueryWithUserIntent(
            $searchQuery,
            $requestParameters
        );
    }
}
