<?php

namespace DevHun\Delynet\ApiCall;

use DevHun\Delynet\Adapter\AdapterInterface;

abstract class AbstractApiCall
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string Delynet WEBFAX AgentId
     */
    protected $agentId;

    public function __construct(AdapterInterface $adapter, $agentId)
    {
        $this->adapter = $adapter;
        $this->agentId = $agentId;
    }
}