# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.4.0] - 2025-10-27

### Added
- Added PHP 8.5 support to CI test matrix ([#13](https://github.com/koriym/Koriym.Psr4List/pull/13))
- Added CLAUDE.md for repository guidance

### Fixed
- Fixed `SortingIterator::getIterator()` return type compatibility with PHP 8.1+ by changing return type from `ArrayIterator` to `Traversable` to match `IteratorAggregate` interface signature ([#14](https://github.com/koriym/Koriym.Psr4List/pull/14))
- Fixed coding style issue in `SortingIterator` (each PHP statement on separate line)

## [1.3.0] - Previous release

(Earlier changelog entries to be added)