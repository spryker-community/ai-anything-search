# Hackathon Project
Created by team ***Ai Pathfinder***.

## Short Project Description
xxx

## 📹 Team Demo

xxx

## Pre-requisite:
1. To generate Gemini Api key [click here](https://aistudio.google.com/app/apikey)
2. Setup a Pinecone SaaS account [click here](https://login.pinecone.io/login)
3. Setup env variable:

    - GEMINI_API_KEY with key or add key in **config/shared/config_default.php**

    ```php
    $config[ImageToTextConstants::GEMINI_API_KEY]  = 'api_key';
    ```

    - GEMINI_HOST_ENDPOINT with API endpoint or add key in **config/shared/config_default.php**

    ```php
    $config[ImageToTextConstants::GEMINI_HOST_ENDPOINT]  = 'host_url';
   ```

    - PINECONE_API_KEY with key or add key in **config/shared/config_default.php**

    ```php
    $config[ImageToTextConstants::GEMINI_HOST_ENDPOINT]  = 'host_url';
    ```

## Modules and path:

*config/Shared/config_default.php has two configuration:*

```php
$config[ImageToTextConstants::GEMINI_HOST_ENDPOINT] = getenv('GEMINI_HOST_ENDPOINT') ? : 'host_url';
```

```php
$config[ImageToTextConstants::GEMINI_API_KEY] = getenv('GEMINI_API_KEY') ? : 'api_key';
```

1. delete your ELS index (`console elasticsearch:index:delete`) and rebuild it (`console search:setup`)
2. re-sync your data to ELS (`console sync:data`)
3. add the QueryExpanderPlugin (``\Pyz\Client\AiAnythingSearch\Plugin\Catalog\UserIntentQueryExpanderPlugin``) to ``\Pyz\Client\Catalog\CatalogDependencyProvider``
4. add the PublisherPlugin (`xx`) to ``\Pyz\Zed\Publisher\PublisherDependencyProvider``

## Setup:

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

### Capabilities:

- xxx

### How to use:

