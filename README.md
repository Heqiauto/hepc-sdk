Hepc SDK
========
[![Build Status](https://travis-ci.org/Heqiauto/hepc-sdk.svg)](https://travis-ci.org/Heqiauto/hepc-sdk)
[![Latest Stable Version](https://poser.pugx.org/Heqiauto/hepc-sdk/v/stable.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![Total Downloads](https://poser.pugx.org/Heqiauto/hepc-sdk/downloads.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![Latest Unstable Version](https://poser.pugx.org/Heqiauto/hepc-sdk/v/unstable.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk) 
[![License](https://poser.pugx.org/Heqiauto/hepc-sdk/license.svg)](https://packagist.org/packages/Heqiauto/hepc-sdk)

Sdk client for Heqiauto-epc service.

Install
--------

```shell
composer require heqiauto/hepc-sdk
```

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

[API Documents](doc/index.md) [Release Log](RELEASE.md)

License
-------
The Hepc SDK is open-sourced software licensed under the [Apache License](https://opensource.org/licenses/Apache-2.0).

