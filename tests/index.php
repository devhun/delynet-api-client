<?php

/**
 * whideshot.co.kr PHP API Client.
 *
 * Dummy API endpoint to allow actual adapter tests but with dummy data.
 *
 * @author  https://github.com/devhun
 * @license https://opensource.org/licenses/mit-license.php MIT
 *
 * @see     https://github.com/devhun/wideshot-api-client
 */
require_once 'DummyData.php';

// Out fake 'content store'
$jsonData = new DevHun\Delynet\Tests\DummyData();

// Grab requested url.
$url = ltrim($_SERVER['PATH_INFO'], '/');

// Prepare arguments.
$args = array_merge($_GET, $_POST);

// Return fake data.
header('Content-Type: application/json');
echo 
    $jsonData->getResponse($url, $args);
