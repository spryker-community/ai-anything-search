<?php

namespace Pyz\Client\AiAnythingSearch\Expander;

use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

interface UserIntentQueryExpanderInterface
{
    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQueryWithUserIntent(QueryInterface $searchQuery, array $requestParameters): QueryInterface;
}
