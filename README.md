# PHP API client for Delynet WEBFAX

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
