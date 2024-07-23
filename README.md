# Payment platform api interface

[![Latest Version on Packagist](https://img.shields.io/packagist/v/propaysystems/payment-platform-api-interface.svg?style=flat-square)](https://packagist.org/packages/propaysystems/payment-platform-api-interface)
[![Tests](https://github.com/PropaySystems/payment-platform-api-interface/actions/workflows/run-tests.yml/badge.svg)](https://github.com/PropaySystems/payment-platform-api-interface/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/propaysystems/payment-platform-api-interface.svg?style=flat-square)](https://packagist.org/packages/propaysystems/payment-platform-api-interface)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require propaysystems/payment-platform-api-interface
```

## Usage

```php
$client = new PaymentPlatformAPI('token', 'v1');
$client = PaymentPlatformAPI::getInstance('token', 'v1'); //Singleton
$response = $client->getContacts($filters = [], $includes = [], $version = 'v1');
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
