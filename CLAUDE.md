# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

`Koriym.Psr4List` is a PHP library that retrieves lists of classes and files corresponding to a specified namespace prefix and directory, based on the PSR-4 autoloading standard. The library is intentionally simple and lightweight with minimal dependencies.

## Core Architecture

### Main Components

- **`Psr4List`** (src/Psr4List.php): Main class that generates a list of class names and file paths. It's invokable and uses a Generator pattern to yield `[class-string, file-path]` tuples. The class automatically filters results to only include valid classes and interfaces (using `class_exists()` and `interface_exists()`).

- **`SortingIterator`** (src/SortingIterator.php): Custom iterator that sorts PHP files by directory depth first, then alphabetically. This ensures consistent ordering where shallower classes appear before nested ones (e.g., `One` before `Sub\Three` before `Sub\Sub\Four`).

### Key Design Patterns

- **Generator Pattern**: The `Psr4List::__invoke()` method returns a Generator for memory-efficient iteration over large namespaces
- **PSR-4 Compliance**: Converts filesystem paths to fully-qualified class names following PSR-4 rules (directory separators → namespace separators)
- **Validation**: Only yields classes/interfaces that actually exist (filters out non-class PHP files)

## Development Commands

### Testing

```bash
# Run all tests
./vendor/bin/phpunit

# Tests are located in tests/ directory with *Test.php suffix
# Test fixtures are in tests/Fake/src/ (namespace: FakeVendor\FakePackage)
```

### Code Quality

```bash
# Run PHP_CodeSniffer (PSR12 + Doctrine coding standards)
./vendor-bin/phpcs/vendor/bin/phpcs

# Run Psalm static analysis (error level 1 - strictest)
./vendor/bin/psalm

# Run PHPMD
./vendor/bin/phpmd src,tests text phpmd.xml
```

### Dependencies

```bash
# Install dependencies
composer install

# The project uses bamarni/composer-bin-plugin for managing dev tools
# PHPCS tools are installed separately in vendor-bin/phpcs/
```

## Testing Strategy

The test suite uses a fake PSR-4 structure in `tests/Fake/src/` with namespace `FakeVendor\FakePackage`. Tests verify:
- Correct class enumeration in order (by depth, then alphabetically)
- Proper file path generation
- Handling of invalid namespace prefixes (should return empty results)

## Code Standards

- **PHP Compatibility**: Minimum PHP 7.0 (as configured in phpcs.xml)
- **Type Safety**: Uses `declare(strict_types=1)` in all files
- **Coding Style**: PSR12 + Doctrine coding standards with specific exclusions defined in phpcs.xml
- **Static Analysis**: Psalm level 1 (strictest)
- **Documentation**: DocBlocks include psalm/phpstan type annotations for generics and return types

## CI/CD

The project runs tests across multiple PHP versions (7.2, 7.3, 7.4, 8.1, 8.2, 8.3, 8.4, 8.5) on both Ubuntu and Windows via GitHub Actions.
