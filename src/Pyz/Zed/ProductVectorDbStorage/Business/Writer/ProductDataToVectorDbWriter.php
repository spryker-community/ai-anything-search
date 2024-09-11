<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business\Writer;

use Pyz\Client\Pinecone\PineconeClientInterface;
use Pyz\Zed\ProductVectorDbStorage\Persistence\ProductVectorDbStorageRepository;

class ProductDataToVectorDbWriter
{
    /**
     * @param \Pyz\Client\Pinecone\PineconeClientInterface $pineconeClient
     */
    public function __construct(
        protected readonly PineconeClientInterface $pineconeClient,
        protected readonly ProductVectorDbStorageRepository $repository,
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
