# Tinify PHP SDK

[![Stable Version](https://img.shields.io/packagist/v/secco2112/tinify-php-sdk)](https://packagist.org/packages/secco2112/tinify-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/secco2112/tinify-php-sdk.svg?style=flat)](https://packagist.org/packages/secco2112/tinify-php-sdk)

This is an unofficial PHP SDK for manipulating Tinify API [Tinify API](https://tinypng.com/developers) data. Here is an example:

```php
<?php

use Secco2112\Tinify\Config;
use Secco2112\Tinify\Options;
use Secco2112\Tinify\Tinify;

$config = new Config([
    Options::TINIFYOPT_API_KEY => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
]);

$tinify = new Tinify;
$tinify->setConfig($config);

$file_url = 'https://tinypng.com/images/example-orig.png';

$tinify->fromUrl($file_url)->download();
```

## Installation

```
$ composer require secco2112/tinify-php-sdk
```

```json
{
    "require": {
        "secco2112/tinify-php-sdk": "*"
    }
}
```

```php
<?php
require 'vendor/autoload.php';

use Secco2112\Tinify\Tinify;

$tinify = new Tinify;
```

## Docs

Click on one of the following sections to be redirected to the documentation:

1. Configuration
2. Shrink from file
3. Shrink from URL
4. Shrink from binary string
5. Handle the data of shrank image
6. Download image
7. Resize methods
8. Store in storage services
