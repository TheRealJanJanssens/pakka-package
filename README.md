# Pakka in a package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/therealjanjanssens/pakka.svg?style=flat-square)](https://packagist.org/packages/therealjanjanssens/pakka)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/therealjanjanssens/pakka/run-tests?label=tests)](https://github.com/therealjanjanssens/pakka/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/therealjanjanssens/pakka.svg?style=flat-square)](https://packagist.org/packages/therealjanjanssens/pakka)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require therealjanjanssens/pakka
```

We also prepared a complete setup for the pakka package with following command
```bash
php artisan pakka-install
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="TheRealJanJanssens\Pakka\PakkaServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="TheRealJanJanssens\Pakka\PakkaServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$pakka = new TheRealJanJanssens\Pakka();
echo $pakka->echoPhrase('Hello, TheRealJanJanssens!');
```

## Testing

```bash
composer test
```

## Custom sections, templates and layouts
If you need to change a particular section, template or layout you can simply add a 'sections', 'templates' or 'layouts' folder in your views. You can put a copy of existing resources in the folder you just made and do all the changes you want. When you update the package this folder won't be updated so your custom resources will be untouched.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jan Janssens](https://github.com/TheRealJanJanssens)
- [All Contributors](../../contributors)

<!-- ## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. -->
