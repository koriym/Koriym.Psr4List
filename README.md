# Koriym.Psr4List
[![Build Status](https://travis-ci.org/koriym/Koriym.Psr4List.svg?branch=master)](https://travis-ci.org/koriym/Koriym.Psr4List)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/?branch=master)

Returns the name of the classes in PSR4 path.

## Requirements
 * PHP 5.5+
 * hhvm

## Installation

```bash
$ composer require koriym/psr4list ~1.0@dev
```

## Usage

```php
use Koriym\Psr4List;

$list = new Psr4List;
$prefix = 'BEAR\Sunday';
$path = __DIR__ . '/src';

foreach ($list($prefix, $path) as list($class, $file)) {
    var_dump($class);
    var_dump($file);
}
```

