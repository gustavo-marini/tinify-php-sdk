# Tinify PHP SDK

[![Stable Version](https://img.shields.io/packagist/v/secco2112/tinify-php-sdk?)](https://packagist.org/packages/secco2112/tinify-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/secco2112/tinify-php-sdk.svg?style=flat)](https://packagist.org/packages/secco2112/tinify-php-sdk)
[![Code Quality](https://www.code-inspector.com/project/21159/score/svg?)](https://frontend.code-inspector.com/public/project/21159/tinify-php-sdk/dashboard)

This is an unofficial PHP SDK for manipulating [Tinify API](https://tinypng.com/developers) data. Here is an example:

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

1. [Getting started](https://github.com/Secco2112/tinify-php-sdk/wiki/Getting-started)
2. Shrink from file
3. Shrink from URL
4. Shrink from binary string
5. Handle the data of shrank image
6. Download image
7. Save image on path
8. Extract binary string of shrank image
9. Resize methods
10. Store in storage services
