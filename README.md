# PHP API client for Delynet WEBFAX

[![Build Status](https://travis-ci.org/devhun/delynet-api-client.svg?branch=master)](https://travis-ci.org/devhun/delynet-api-client)
[![Latest Stable Version](https://poser.pugx.org/devhun/delynet-api-client/version)](https://packagist.org/packages/devhun/delynet-api-client)
[![Total Downloads](https://poser.pugx.org/devhun/delynet-api-client/downloads)](https://packagist.org/packages/devhun/delynet-api-client)
[![License](https://poser.pugx.org/devhun/delynet-api-client/license)](https://packagist.org/packages/devhun/delynet-api-client)

## Install using composer

Open a shell, `cd` to your poject and type:

```sh
composer require devhun/delynet-api-client
```

or edit composer.json and add:

```json
{
    "require": {
        "devhun/delynet-api-client": "~1.0"
    }
}
```

If you want to use the `GuzzleHttpAdapter`, you will need to add [Guzzle 6](https://github.com/guzzle/guzzle).

## Usage examples

###### Guzzle

```php
require 'vendor/autoload.php';

use DevHun\Delynet\DelynetClient;
use DevHun\Delynet\Adapter\GuzzleHttpAdapter;

// Using Guzzle 6...
$client = new DelynetClient(
    new GuzzleHttpAdapter(),
    'your-agent-id'
);

$result = $client->fax()->{method}();

var_export($result);
```

###### CURL

```php
require 'vendor/autoload.php';

use DevHun\Delynet\DelynetClient;
use DevHun\Delynet\Adapter\CurlAdapter;

// Using regular CURL, courtesy of 'malc0mn'
$client = new DelynetClient(
    new CurlAdapter(),
    'your-agent-id'
);

$result = $client->fax()->{method}();

var_export($result);
```
