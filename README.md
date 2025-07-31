# Payment platform api interface

[![Tests](https://github.com/PropaySystems/payment-platform-api-interface/actions/workflows/run-tests.yml/badge.svg)](https://github.com/PropaySystems/payment-platform-api-interface/actions/workflows/run-tests.yml)

This package provides an interface for integrating with the payment API, facilitating seamless interactions and transactions. It simplifies the process of connecting to the payment API by abstracting the underlying HTTP requests and responses into a more user-friendly set of PHP methods. Users can easily install this package via Composer and start integrating their applications with the payment API, leveraging its functionalities to manage contacts, initiate payments, and query transaction statuses, among other features.

## Installation

You can install the package via composer:

```bash
composer require propaysystems/payment-platform-api-interface
```

### PHP Usage

```php
$client = PaymentPlatformAPI::getInstance() //Singleton
         ->sandbox() //Use sandbox environment
         ->url('https://example.com') //Set host only if you have a custom host
         ->setVersion('v1')
         ->setCredentials('username', 'password');
         or
        ->setToken('132465789132465789');

//Get all contacts
$response = $client->contacts($filters = [], $includes = ['bankAccounts', 'products'], $sort = ['-contact_number'], $version = 'v1', $per_page = 10, $page = 1)->get();

Sorting is ascending by defailt  and can be reversed by adding a hyphen (-) to the start of the property name

Example:
$sort = ['name', '-created_at'];

```
### Laravel Usage
Create config file
```php
return [
    'url' => env('PAYMENT_PLATFORM_API_URL', ''),
    'version' => env('PAYMENT_PLATFORM_API_VERSION', 'v1'),
    'username' => env('PAYMENT_PLATFORM_API_USERNAME', 'secret'),
    'password' => env('PAYMENT_PLATFORM_API_PASSWORD', 'password'),
];
```

Register in the boot method of the app service provider
```php

$this->app->bind(PaymentPlatformAPI::class, function() {
    return PaymentPlatformAPI::getInstance()
        ->url(config('custom.payment-platform-api.url'))
        ->setVersion(config('custom.payment-platform-api.version'))
        ->setCredentials(
            config('custom.payment-platform-api.username'), 
            config('custom.payment-platform-api.password')
        );
});

```

Use the singleton class in your application
```php
$client = app(PaymentPlatformAPI::class);
```
## Testing

```bash
composer test
```

## Testing Coverage Report

```bash
XDEBUG_MODE=coverage ./vendor/bin/pest --coverage --coverage-xml=logs/coverage
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marius Odendaal](https://github.com/PropaySystems)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
