# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [2.0.0] - 2021-11-28
### Added
- Add support for PHP v7.4 & v8.0 .
- Type declarations have been added to all parameters and return types.
- Validation with `\InvalidArgumentException` for the `base_convert()`
  parameters to match the warnings added for the original PHP function in v7.4.
  - `$number` must be a string using only *alphanumeric* characters.
  - `$fromBase` and `$toBase` must be an integer between *2* and *36*.
### Removed
- **BC break**: Removed support for PHP versions <= v7.3 as they are no longer
  [actively supported](https://php.net/supported-versions.php) by the PHP project.

## [1.0.0] - 2016-02-26
- Initial release.
