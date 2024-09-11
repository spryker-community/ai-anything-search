<?php

namespace Pyz\Client\AiAnythingSearch\Expander;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MultiMatch;
use InvalidArgumentException;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class UserIntentQueryExpander implements UserIntentQueryExpanderInterface
{
    /**
     * @var string
     */
    protected const SKU = 'search-result-data.abstract_sku';

    /**
     * @inheritDoc
     */
    public function expandQueryWithUserIntent(QueryInterface $searchQuery, array $requestParameters): QueryInterface
    {
        if (!array_key_exists('q', $requestParameters)) {
            return $searchQuery;
        }

        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        // embed the query & search for vector

        // extract SKUs from result
        $boostedSkus = $this->resolveSkusFromResponse(null);

        // inject in search Query (as OR-statement)
        $this->injectSearch($boostedSkus, $boolQuery);

        // boost in term query (clustered by range?)
        $this->injectBoosting($boostedSkus, $boolQuery);

        dump(json_encode($boolQuery->toArray()));

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query)
    {
        /** @var \Elastica\Query\AbstractQuery|array $boolQuery */
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'AiAnythingSearch Query Expander available only with %s, got: %s',
                BoolQuery::class,
                is_object($boolQuery) ? get_class($boolQuery) : gettype($boolQuery),
            ));
        }

        return $boolQuery;
    }

    /**
     * @param $response
     *
     * @return array
     */
    protected function resolveSkusFromResponse($response = null): array
    {
        $response = $response ?? [
            [
                'weight' => -0.234,
                'sku' => '123'
            ],
            [
                'weight' => 0.234,
                'sku' => '002'
            ],
            [
                'weight' => 0.434,
                'sku' => '243'
            ],
            [
                'weight' => 0.534,
                'sku' => '012'
            ],
            [
                'weight' => 0.823,
                'sku' => '036'
            ],
        ];

        return array_filter($response, fn($entry) => $entry['weight'] > 0);
    }

    /**
     * @param array $boostedSkus
     * @param \Elastica\Query\BoolQuery $searchQuery
     *
     * @return void
     */
    protected function injectSearch(array $boostedSkus, BoolQuery $searchQuery): void
    {
        $skus = array_column($boostedSkus, 'sku');
        $skuTermQuery = new Query\Terms(self::SKU);
        $skuTermQuery->setTerms($skus);

        $mustQueries = $searchQuery->getParam('must');

        foreach ($mustQueries as $key => $mustQuery) {
            if ($mustQuery instanceof MultiMatch && $mustQuery->hasParam('query')) {
                $boolConjunction = new BoolQuery();
                $boolConjunction->addShould($mustQuery);
                $boolConjunction->addShould($skuTermQuery);
                $mustQueries[$key] = $boolConjunction;
            }
        }

        $searchQuery->setParam('must', $mustQueries);
    }

    /**
     * @param array $boostedSkus
     * @param \Elastica\Query\BoolQuery $searchQuery
     *
     * @return void
     */
    protected function injectBoosting(array $boostedSkus, BoolQuery $searchQuery): void
    {
        $groupedSkus = [
            '5' => [],
            '10' => [],
            '15' => [],
            '20' => [],
        ];

        foreach ($boostedSkus as $boostedSku) {
            if ($boostedSku['weight'] < 0.26) {
                $groupedSkus['5'][] = $boostedSku['sku'];
            } else if ($boostedSku['weight'] < 0.51) {
                $groupedSkus['10'][] = $boostedSku['sku'];
            } else if ($boostedSku['weight'] < 0.76) {
                $groupedSkus['15'][] = $boostedSku['sku'];
            } else {
                $groupedSkus['20'][] = $boostedSku['sku'];
            }
        }

        foreach ($groupedSkus as $boost => $skus) {
            $shouldBoost = new Query\Terms(self::SKU);
            $shouldBoost->setTerms($skus);
            $shouldBoost->setBoost($boost);
            $searchQuery->addShould($shouldBoost);
        }
    }
}
