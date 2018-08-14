<?php
/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Core;

use Google\Auth\ApplicationDefaultCredentials;
use Google\Auth\Cache\MemoryCacheItemPool;
use Google\Auth\CredentialsLoader;
use Google\Auth\FetchAuthTokenCache;
use Google\Auth\FetchAuthTokenInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Encapsulates shared functionality of request wrappers.
 */
trait RequestWrapperTrait
{
    /**
     * @var CacheItemPoolInterface A cache used for storing tokens.
     */
    private $authCache;

    /**
     * @var array Cache configuration options.
     */
    private $authCacheOptions;

    /**
     * @var FetchAuthTokenInterface Fetches credentials.
     */
    private $credentialsFetcher;

    /**
     * @var array The contents of the service account credentials .json file
     * retrieved from the Google Developers Console.
     */
    private $keyFile;

    /**
     * @var int Number of retries for a failed request. **Defaults to** `3`.
     */
    private $retries;

    /**
     * @var array Scopes to be used for the request.
     */
    private $scopes = [];

    /**
     * Sets common defaults between request wrappers.
     *
     * @param array $config {
     *     Configuration options.
     *
     *     @type CacheItemPoolInterface $authCache A cache for storing access
     *           tokens. **Defaults to** a simple in memory implementation.
     *     @type array $authCacheOptions Cache configuration options.
     *     @type FetchAuthTokenInterface $credentialsFetcher A credentials
     *           fetcher instance.
     *     @type array $keyFile The contents of the service account credentials
     *           .json file retrieved from the Google Developer's Console.
     *           Ex: `json_decode(file_get_contents($path), true)`.
     *     @type int $retries Number of retries for a failed request.
     *           **Defaults to** `3`.
     *     @type array $scopes Scopes to be used for the request.
     * }
     * @throws \InvalidArgumentException
     */
    public function setCommonDefaults(array $config)
    {
        $config += [
            'authCache' => new MemoryCacheItemPool(),
            'authCacheOptions' => [],
            'credentialsFetcher' => null,
            'keyFile' => null,
            'retries' => null,
            'scopes' => null
        ];

        if ($config['credentialsFetcher'] && !$config['credentialsFetcher'] instanceof FetchAuthTokenInterface) {
            throw new \InvalidArgumentException('credentialsFetcher must implement FetchAuthTokenInterface.');
        }

        if (!$config['authCache'] instanceof CacheItemPoolInterface) {
            throw new \InvalidArgumentException('authCache must implement CacheItemPoolInterface.');
        }

        $this->authCache = $config['authCache'];
        $this->authCacheOptions = $config['authCacheOptions'];
        $this->credentialsFetcher = $config['credentialsFetcher'];
        $this->retries = $config['retries'];
        $this->scopes = $config['scopes'];
        $this->keyFile = $config['keyFile'];
    }

    /**
     * Gets the credentials fetcher and sets up caching. Precedence begins with
     * user supplied credentials fetcher instance, followed by a reference to a
     * key file stream, and finally the application default credentials.
     *
     * @return FetchAuthTokenInterface
     */
    public function getCredentialsFetcher()
    {
        $fetcher = null;

        if ($this->credentialsFetcher) {
            $fetcher = $this->credentialsFetcher;
        } elseif ($this->keyFile) {
            $fetcher = CredentialsLoader::makeCredentials($this->scopes, $this->keyFile);
        } else {
            $fetcher = ApplicationDefaultCredentials::getCredentials($this->scopes, $this->authHttpHandler);
        }

        return new FetchAuthTokenCache(
            $fetcher,
            $this->authCacheOptions,
            $this->authCache
        );
    }
}