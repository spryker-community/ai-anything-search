<?php

namespace Pyz\Zed\AiAnythingVectorDb\Business;

interface AiAnythingVectorDbFacadeInterface
{
    public function writeProductDataToVectorDb(array $transfers):void;
}
