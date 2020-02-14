<?php

namespace DevHun\Delynet\Tests;

class DummyData
{
    private $response = [
        'FaxSendType2.asp' => '{
            "resultcode": "1a",
            "resultdesc": "ok"
        }',
        'FaxResultType2.asp' => '{
            "resultcode": "1a",
            "resultdesc": "ok",
            "resultdata": [
                {
                    "phoneno": "020000000",
                    "docpage": "1",
                    "sendpage": "1",
                    "statuscode": "13",
                    "statusdesc": "전송완료",
                    "sendfee": "30",
                    "starttime": "              ",
                    "endtime": "              "
                }
            ]
        }'
    ];

    public function getResponse($url, array $args)
    {
        $response = '{}';

        if (isset($this->response[$url])) {
            $response = $this->response[$url];
        }

        return $response;
    }
}
