# Getting started with KdrmklabsCurrencyBundle in Symfony2.

## Instalation

### I. Installing the bundle in two different ways.

Install this bundle by adding next code line to your project in the composer.json file and after update it with the command composer update

```json
file: /composer.json

{
    "require": {
        "kdrmklabs/currency-bundle": "dev-master",
    }
}
```

Now, update the bundle with composer:

```
$ composer update kdrmklabs/currency-bundle
```

### II. Enable and register the Bundle in the AppKernel

```php
// file: app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Kdrmklabs\Bundle\CurrencyBundle\KdrmklabsCurrencyBundle(),
        // ...
        // Your application bundles
    );
}
```

## Configure the bundle.

Add kdrmklabs_ticket configuration to you config.yml

```yml
# file: app/config/config.yml

kdrmklabs_currency:
    default_currency: "USD"
```

## Finally, create database tables, update the schems and populate tables

Update your database schema with the command:

```
$ php app/console doctrine:schema:update --force
```

Populate database:

![image](https://cloud.githubusercontent.com/assets/5240279/17281571/1c1008ca-5762-11e6-9093-db446fcc9339.png)
