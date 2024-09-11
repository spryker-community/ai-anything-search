<?php

namespace Pyz\Client\AiAnythingEmbedding;

interface AiAnythingEmbeddingClientInterface
{
    public function getEmbeddings(string $text);
}
