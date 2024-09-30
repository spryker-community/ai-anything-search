# Hackathon Project

Created by team ***Ai Pathfinder***, WINNER of the September 2024 Spryker Hackathon.

## Short Project Description

Semantic search on the user intent. Similar to AI Algolia but way cheaper. 

### Jury evaluation:
> _The team implemented  multilingual semantic search, ensuring precise matches across languages. A well-organized team contributed significantly to the success, impressing the jury with the accuracy and relevance of the results._

## 📹 Team Demo

xxx

## Pre-requisite

1. To generate Gemini Api key [click here](https://aistudio.google.com/app/apikey)
2. Setup a Pinecone SaaS account [click here](https://login.pinecone.io/login)
3. Setup env variable:

    - GEMINI_API_KEY with key or add key in **config/shared/config_default.php**

    ```php
    $config[AiAnythingEmbeddingConstants::GEMINI_API_KEY]  = 'api_key';
    ```

    - GEMINI_API_URL with API endpoint and model except API Key or add key in **config/shared/config_default.php**

    ```php
    $config[AiAnythingEmbeddingConstants::GEMINI_API_URL] = 'api_url';
   ```

    - PINECONE_API_KEY with key or add key in **config/shared/config_default.php**

    ```php
   $config[PineconeConstants::PINECONE_API_KEY]  = 'api_key';
    ```

- PINECONE_API_VERSION with key or add key in **config/shared/config_default.php**

    ```php
   $config[PineconeConstants::PINECONE_API_VERSION]  = 'api_version';
    ```

  - PINECONE_INDEX_URL with API endpoint or add key in **config/shared/config_default.php**

      ```php
      $config[AiAnythingEmbeddingConstants::PINECONE_INDEX_URL] = 'api_url';
   ```

## Modules and path

1. delete your ELS index (`console elasticsearch:index:delete`) and rebuild it (`console search:setup`)
2. re-sync your data to ELS (`console sync:data`)
3. add the QueryExpanderPlugin (``\Pyz\Client\AiAnythingSearch\Plugin\Catalog\UserIntentQueryExpanderPlugin``) to ``\Pyz\Client\Catalog\CatalogDependencyProvider``
4. add the PublisherPlugin (`xx`) to ``\Pyz\Zed\Publisher\PublisherDependencyProvider``

## Setup

1. clone the repository in your local

   ```php
   git clone git@github.com:spryker-community/ai-anything-search.git
   ```

2. clone docker sdk

    ```php
     git clone https://github.com/spryker/docker-sdk.git --single-branch docker
    ```

3. bootstrap the project

    ```php
    docker/sdk bootstrap deploy.dev.yml
    ```

4. start the project

 ```php
        docker/sdk up
 ```

if you come across any installation error, please run following command:

```php
        docker/sdk reset
 ```

caution:  if you run this command, all the data stored in your spryker docker volumes will be destroyed.

### Capabilities

- xxx

### How to use
