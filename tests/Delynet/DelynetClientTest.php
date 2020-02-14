<?php

namespace DevHun\Delynet\Tests;

use DevHun\Delynet\Adapter\CurlAdapter;
use DevHun\Delynet\Adapter\GuzzleHttpAdapter;
use DevHun\Delynet\DelynetClient;
use PHPUnit\Framework\TestCase;

class DelynetClientTest extends TestCase
{
    public function testConstruct()
    {
        $adapterClass = 'DevHun\\Delynet\\Adapter\\'.getenv('ADAPTER');

        /**
         * @var $adapter CurlAdapter|GuzzleHttpAdapter
         */
        $adapter = new $adapterClass();
        $adapter->setEndpoint(getenv('ENDPOINT'));

        $client = new DelynetClient($adapter, getenv('AGENTID'));

        $this->assertInstanceOf('DevHun\\Delynet\\DelynetClient', $client);
    }
}