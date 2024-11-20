<?php

declare(strict_types = 1);

namespace Pyz\Zed\AiAnythingVectorDb\Persistence;

use Orm\Zed\Category\Persistence\SpyCategoryAttribute;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AiAnythingVectorDb\Persistence\ProductVectorDbStoragePersistenceFactory getFactory()
 */
class AiAnythingVectorDbRepository extends AbstractRepository implements AiAnythingVectorDbRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return array
     */
    public function queryProductData(string $id): array
    {
        $productData = SpyProductAbstractQuery::create()
            ->filterByIdProductAbstract($id)->findOne();

        $localizedAttr = SpyProductAbstractLocalizedAttributesQuery::create()
            ->filterByFkLocale(66)
            ->filterByFkProductAbstract($id)->findOne();

        $categories = SpyProductCategoryQuery::create()
            ->filterByFkProductAbstract($id)
            ->joinWithSpyCategory()
            ->find()->getData();

        $categoryNames = [];

        /** @var \Orm\Zed\ProductCategory\Persistence\SpyProductCategory $category */
        foreach ($categories as $category) {
            $categoryAttributes = $category->getSpyCategory()->getAttributes()->getData();
            array_filter($categoryAttributes, fn(SpyCategoryAttribute $attribute) => $attribute->getFkLocale() === 66);
            /** @var SpyCategoryAttribute $categoryAttribute */
            $categoryAttribute = current($categoryAttributes);
            $categoryNames[] = $categoryAttribute->getName();
        }

        return [
            'attributes' => $productData->getAttributes(),
            'name' => $localizedAttr->getName(),
            'sku' => $productData->getSku(),
            'categories' => $categoryNames,
            'description' => $localizedAttr->getDescription(),
        ];
    }

}
