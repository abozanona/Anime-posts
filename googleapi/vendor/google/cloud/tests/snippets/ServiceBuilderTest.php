<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Tests\Snippets;

use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Dev\Snippet\SnippetTestCase;
use Google\Cloud\Logging\LoggingClient;
use Google\Cloud\NaturalLanguage\NaturalLanguageClient;
use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\ServiceBuilder;
use Google\Cloud\Speech\SpeechClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Translate\TranslateClient;
use Google\Cloud\Vision\VisionClient;

/**
 * @group root
 */
class ServiceBuilderTest extends SnippetTestCase
{
    private $cloud;

    public function setUp()
    {
        $this->cloud = new ServiceBuilder;
    }

    public function testConstructor()
    {
        $snippet = $this->snippetFromMethod(ServiceBuilder::class, '__construct');
        $this->assertInstanceOf(ServiceBuilder::class, $snippet->invoke('cloud')->returnVal());
    }

    public function serviceBuilderMethods()
    {
        return [
            ['bigQuery', BigQueryClient::class, 'bigQuery'],
            ['datastore', DatastoreClient::class, 'datastore'],
            ['logging', LoggingClient::class, 'logging'],
            ['naturalLanguage', NaturalLanguageClient::class, 'language'],
            ['pubsub', PubSubClient::class, 'pubsub'],
            ['speech', SpeechClient::class, 'speech'],
            ['storage', StorageClient::class, 'storage'],
            ['vision', VisionClient::class, 'vision'],
            ['translate', TranslateClient::class, 'translate']
        ];
    }

    /**
     * @dataProvider serviceBuilderMethods
     */
    public function testServices($method, $returnType, $returnName)
    {
        $snippet = $this->snippetFromMethod(ServiceBuilder::class, $method);
        $snippet->addLocal('cloud', $this->cloud);
        $res = $snippet->invoke($returnName);

        $this->assertInstanceOf($returnType, $res->returnVal());
    }
}
