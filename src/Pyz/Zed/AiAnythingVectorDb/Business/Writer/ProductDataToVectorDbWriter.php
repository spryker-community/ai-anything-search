<?php

namespace Pyz\Zed\AiAnythingVectorDb\Business\Writer;

use Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface;
use Pyz\Zed\AiAnythingVectorDb\Persistence\AiAnythingVectorDbRepository;

class ProductDataToVectorDbWriter
{
    /**
     * @param \Pyz\Client\AiAnythingVectorDb\AiAnythingVectorDbClientInterface $pineconeClient
     * @param \Pyz\Zed\AiAnythingVectorDb\Persistence\AiAnythingVectorDbRepository $repository
     */
    public function __construct(
        protected readonly AiAnythingVectorDbClientInterface $pineconeClient,
        protected readonly AiAnythingVectorDbRepository $repository,
    )
    {
    }

    /**
     * @param array $transfers
     *
     * @return void
     */
    public function write(array $transfers): void
    {
        /** @var \Generated\Shared\Transfer\EventEntityTransfer $transfer */
        foreach ($transfers as $transfer) {
            $productData = $this->repository->queryProductData($transfer->getId());

            $sku = $productData['sku'];
            $data = [
                sprintf('Name: %s', $productData['name']),
                sprintf('Description: %s', $productData['description']),
            ];

            $attributes = $productData['attributes'] !== '' ? json_decode($productData['attributes']) : [];

            foreach ($attributes as  $attribute => $value) {
                $data[] = sprintf('%s: %s', str_replace('_', ' ', ucwords($attribute, '_')), $value);
            }

            foreach ($productData['categories'] as  $category) {
                $data[] = sprintf('Category: %s', $category);
            }

            $this->pineconeClient->upsert($sku, $data, [
                'category' => $category
            ]);
        }
    }
}
