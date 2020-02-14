<?php

namespace DevHun\Delynet\Adapter;

use DevHun\Delynet\Exception\ApiException;

abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * Throw error with explanation of what hapend.
     *
     * @param int    $code
     * @param string $response
     *
     * @throws ApiException
     */
    protected function reportError($code, $response)
    {
        switch ($code) {
            case 200:
                $responseObj = json_decode($response, true);

                if (substr($responseObj['resultcode'], 0, 1) !== '1') {
                    throw new ApiException($responseObj['resultdesc']);
                }
                break;
            default:
                throw new ApiException("Unknown Error");
                break;
        }
    }
}