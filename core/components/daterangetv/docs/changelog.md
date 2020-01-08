# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.3.5] - 2020-01-08
### Changed
- Change log level of not existing template variable message to debug
- PHP/MODX version check
- Normalized/refactored code
- Prevent an error, when $modx->resource is not set

## [1.3.4] - 2018-11-17
### Changed
- Bugfix for allowBlank option [#10]

## [1.3.3] - 2017-07-12
### Changed
- Bugfix for mandatory first date even if allowBlank is set to true [#10]

## [1.3.2] - 2017-02-16
### Changed
- Bugfix for an issue when allowBlank is set to false [#9]
- Bugfix for years first check in DaterangeTV.Renderer

## [1.3.1] - 2016-11-22
### Changed
- Improved backwards compatibility when switching a datereange TV to use a second TV for an end value [#6]

## [1.3.0] - 2016-09-14
### Added
- Optional second template variable for the end part of the datereange. Could be set to i.e. a hidden template variable

## [1.2.3] - 2016-02-07
### Added
- Allow date format ordering other than d-m-y (thanks to smg6511)
- Added stripEqualParts snippet property
- Log only errors with enabled debug snippet property

## [1.2.2] - 2015-09-17
### Changed
- Improved support for manager_date_format and daterangetv.manager_format
- Improved handling of invalid values in DaterangeTV.Renderer

## [1.2.1] - 2015-08-06
### Changed
- Bugfix for snippet call in manager context (i.e. MIGX column renderer)

## [1.2.0] - 2015-06-17
### Added
- Added column renderer (for MIGX/Collections etc.)
- Added default output system settings

## [1.1.0] - 2013-02-19
### Added
- Added snippet/output filter

## [1.0.1] - 2013-02-15
### Changed
- Removed debug code

## [1.0.0] - 2013-01-16
### Added
- Initial release for MODX Revolution
