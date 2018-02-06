Hepc SDK
========
[![Build Status](https://travis-ci.org/Heqiauto/hepc-sdk.svg)](https://travis-ci.org/Heqiauto/hepc-sdk)
[![Coverage Status](https://coveralls.io/repos/github/Heqiauto/hepc-sdk/badge.svg?branch=master)](https://coveralls.io/github/Heqiauto/hepc-sdk?branch=master)
[![Latest Stable Version](https://poser.pugx.org/Heqiauto/hepc-sdk/v/stable.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![Total Downloads](https://poser.pugx.org/Heqiauto/hepc-sdk/downloads.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![Latest Unstable Version](https://poser.pugx.org/Heqiauto/hepc-sdk/v/unstable.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![License](https://poser.pugx.org/Heqiauto/hepc-sdk/license.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk)

Sdk client for Heqiauto-epc service.

Installation
------------
It's recommended that you use [Composer](https://getcomposer.org/) to install this project.

```bash
composer require heqiauto/hepc-sdk
```

This will install the library and all required dependencies. The library requires PHP 5.5 or newer.

Usage
-----

```php
use Heqiauto\HepcSdk\HepcClient;
use Heqiauto\HepcSdk\CarBrand;

$client = new HepcClient('api-host', 'your-key', 'your-secret');
$carBrand = new CarBrand($client)
$brands = $carBrand->getCarBrands();
```

Documents
----------

+ [API Documents](doc/README.md)
+ [Release Log](RELEASE.md)

License
-------
The Hepc SDK is open-sourced software licensed under the [Apache License](https://opensource.org/licenses/Apache-2.0).

