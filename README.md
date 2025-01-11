# Koriym.Psr4List
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/koriym/Koriym.Psr4List/?branch=master)
[![Continuous Integration (legacy)](https://github.com/koriym/Koriym.Psr4List/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/koriym/Koriym.Psr4List/actions/workflows/continuous-integration.yml)

`Koriym\Psr4List` is a simple library for retrieving a list of all classes and files corresponding to a specified namespace prefix and directory, based on the PSR-4 autoloading standard.

---

## Installation

You can install the library via Composer:

```bash
composer require koriym/psr4list
```

---

## Usage

Here’s a basic example of how to use `Koriym\Psr4List`:

```php
use Koriym\Psr4List\Psr4List;

$list = new Psr4List;
$prefix = 'BEAR\Sunday'; // Namespace prefix
$path = __DIR__ . '/src'; // Corresponding directory

foreach ($list($prefix, $path) as list($class, $file)) {
    echo "Class: $class\n";
    echo "File: $file\n";
}
```

### Example Output

```
Class: BEAR\Sunday\Module\AppModule
File: /path/to/project/src/Module/AppModule.php
Class: BEAR\Sunday\Extension\Router\RouterInterface
File: /path/to/project/src/Extension/Router/RouterInterface.php
```

---

## Features

- **PSR-4 Compliant**: Works based on the PSR-4 autoloading standard.
- **Simple and Lightweight**: Minimal dependencies, easy to integrate into any project.
- **Flexible**: Perfect for enumerating classes within a specific namespace.

---

## Use Cases

- Enumerate all classes under a specific namespace in your project.
- Verify the correspondence between classes and their files.
- Use as part of refactoring or code analysis tools.

---

## License

This library is licensed under the [MIT License](LICENSE).

