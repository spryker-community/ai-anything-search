# Ai ANYTHING Search

## How to setup?

To use our extension you need to follow a few steps:

1. delete your ELS index (`console elasticsearch:index:delete`) and rebuild it (`console search:setup`)
2. re-sync your data to ELS (`console sync:data`)
3. add the QueryExpanderPlugin (``\Pyz\Client\AiAnythingSearch\Plugin\Catalog\UserIntentQueryExpanderPlugin``) to ``\Pyz\Client\Catalog\CatalogDependencyProvider``
4. add the PublisherPlugin (`xx`) to ``\Pyz\Zed\Publisher\PublisherDependencyProvider``
5. add your Gemini key to the config as  variable ``GEMINI_API_KEY``
6. add your Pinecone API key to the config as  variable ``PINECONE_API_KEY``
7. add your Pinecone API Verions to the config as  variable ``PINECONE_API_VERSION``
