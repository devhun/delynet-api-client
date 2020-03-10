<?php

namespace DevHun\Delynet\ApiCall;

class Fax extends AbstractApiCall
{
    public function send(array $faxnos, array $files, $userKey)
    {
        $args = [
            'nation'     => 'KOR',
            'docname'    => 'wfsh2',
            'docver'     => '2.1',
            'id'         => $this->agentId,
            'subid'      => '',
            'key'        => $userKey,
            'cid'        => '',
            'userddd'    => '',
            'header'     => '',
            'redial'     => '3',
            'faxnos'     => [],
            'files'      => [],
            'returnpath' => ''
        ];

        foreach ($faxnos as $fax) {
            $args['faxnos'][] = [
                'faxno' => $fax
            ];
        }

        foreach ($files as $file) {
            if (!file_exists(realpath($file))) continue;

            $args['files'][] = [
                'filename' => basename(realpath($file)),
                'filebody' => base64_encode(file_get_contents(realpath($file)))
            ];
        }

        return $this->adapter->post('FaxSendType2.asp', ['a'=>json_encode($args)]);
    }

    public function result($userKey)
    {
        $args = [
            'nation'  => 'KOR',
            'docname' => 'wfsh2',
            'docver'  => '2.1',
            'id'      => $this->agentId,
            'key'     => $userKey,
            'faxno'   => '',
            'option'  => 'ALL'
        ];

        return $this->adapter->post('FaxResultType2.asp', ['a'=>json_encode($args)]);
    }
}