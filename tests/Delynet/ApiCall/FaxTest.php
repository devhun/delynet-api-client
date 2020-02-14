<?php

namespace DevHun\Delynet\Tests;

use DevHun\Delynet\Adapter\CurlAdapter;
use DevHun\Delynet\Adapter\GuzzleHttpAdapter;
use DevHun\Delynet\DelynetClient;
use PHPUnit\Framework\TestCase;

class FaxTest extends TestCase
{
    /**
     * @var DelynetClient
     */
    protected $client;

    public function setUp(): void
    {
        $adapterClass = 'DevHun\\Delynet\\Adapter\\'.getenv('ADAPTER');

        /**
         * @var $adapter CurlAdapter|GuzzleHttpAdapter
         */
        $adapter = new $adapterClass();
        $adapter->setEndpoint(getenv('ENDPOINT'));

        $this->client = new DelynetClient($adapter, getenv('AGENTID'));
    }

    public function testSend()
    {
        $userKey = uniqid();
        $result = $this->client->fax()->send(
            [
                '02000000'
            ],
            [
                __DIR__.'/files/sample.pdf'
            ],
            $userKey);

        $this->assertArrayHasKey('resultcode', $result);
        $this->assertEquals($result['resultcode'], '1a');
    }

    public function testSend4Result()
    {
        $result = $this->client->fax()->send(
            [
                '02000000'
            ],
            [
                __DIR__.'/files/sample.pdf'
            ],
            'USERKEY-1');

        $this->assertArrayHasKey('resultcode', $result);
        $this->assertEquals($result['resultcode'], '1a');
    }

    public function testResult()
    {
        $result = $this->client->fax()->result('USERKEY-1');

        $this->assertArrayHasKey('resultcode', $result);
        $this->assertEquals($result['resultcode'], '1a');
    }
}