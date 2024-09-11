<?php

namespace Pyz\Client\AiAnythingEmbedding\Gemini;

interface GeminiEmbeddingClientInterface
{
    public function getEmbeddings(string $text);
}
