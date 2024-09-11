<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business\Writer;

use Pyz\Client\Pinecone\PineconeClient;
use Pyz\Client\Pinecone\PineconeClientInterface;
use Pyz\Client\Pinecone\Upsert\Upsert;

class ProductDataToVectorDbWriter 
{
    private PineconeClientInterface $pineconeClient;


    public function __construct(PineconeClientInterface $pineconeClient)
    {
        $this->pineconeClient = $pineconeClient;
    }
    
    public function write(array $transfers): void {

        dd($transfers);
        foreach ($transfers as $transfer) {
            $this->pineconeClient->upsert($sku, $data, $metadata);
        }

    }
}