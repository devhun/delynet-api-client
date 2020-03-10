<?php

namespace DevHun\Delynet;

use DevHun\Delynet\Adapter\AdapterInterface;
use DevHun\Delynet\ApiCall\Fax;

class DelynetClient
{
    const ENDPOINT = 'http://14.63.217.230/__UPLOAD_FAC_WEB-1_FAX__/';
    const VERSION = '1.0.1';
    const AGENT = 'Delynet WEBFAX PHP API Client';
    const URL = 'https://github.com/devhun/delynet-api-client';

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @var string WEBFax Agent ID
     */
    private $agentId;

    public function __construct(AdapterInterface $adapter, $agentId)
    {
        $this->adapter = $adapter;
        $this->agentId = $agentId;
    }

    public function fax()
    {
        return new Fax($this->adapter, $this->agentId);
    }
}
