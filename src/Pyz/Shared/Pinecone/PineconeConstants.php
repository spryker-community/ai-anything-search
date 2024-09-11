<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Shared\Pinecone;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface PineconeConstants
{
    /**
     * @var string
     */
    public const PINECONE_API_KEY = 'PINECONE_API_KEY';

    /**
     * @var string
     */
    public const PINECONE_API_VERSION = 'PINECONE_API_VERSION';

    public const PINECONE_INDEX_URL = 'PINECONE_INDEX_URL';
}
