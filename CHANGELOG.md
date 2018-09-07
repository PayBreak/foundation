## Added
- `ArrayAccessTrait`
- `IteratorTrait`

## Changed
- Scrutinizer config (154392323) (153057789)

# v0.17.0
2017-12-21

## Features
- `AbstractEntity` clone handling for object properties

# v0.16.1
2017-07-21

## Bug Fixes 
- Improved `Exception` message in `Range::validateRange()`

# v0.16.0
2017-07-07

## Features
- Added *numeric* type to `AbstractEntity`
- Added `Range`

# v0.15.0
2017-06-28

## Features
- Added Bitwise:: makeFromArray(array $data)

# v0.14.0
2017-01-18

## Bug Fixes
- Wrong file name for `NotFoundException` to meet PSR-4 ( #13 )  

# v0.13.0
2016-08-11

## Features
- Added `ApmService` Contract

# v0.12.1
2016-08-01

## Bug Fixes
- Fixed `Bitwise::remove()`

# v0.12.0
2016-06-17

## Features
- Added `PrefixedLoggerTrait`
- Added *interface* support to `AbstractEntity`

# v0.11.0
2016-05-20

## Features
- Added the `Bitwise` property

# v0.10.0
2016-05-09

## Features
- New concepts:
    - `Indexable`
    - `Persistable`
- Repository concepts
    - `ReadRepository`
    - `Repository`
    - `WriteRepository`

# v0.9.0
2016-03-15

## Features
- Added `AbstractEntity` support for `class[]`
- Added `NameHelper`
- Improved `trigger_error` and `EntityPropertyTrait`
- Doc bloc generator for `AbstractEntity`
- Added `Data` group with `Value`
- Added `Decision` stack
    - `Condition`, `Rule`, `Adviser`
    - `RuleAdvice`, `Advice`
    - `DataSource` concept with aggregator
    - Specific `Exceptions`

# v0.8.0
2016-01-20

## Bug Fixes
- Removed unused `guzzlehttp/guzzle` from dependencies

# v0.7.0
2015-11-16

## First release as PayBreak\foundation

# v0.6.2
2015-07-22

## Bug Fixes
- `AbstractEntity` fixed `null` value on `make()`
- Additional tests for `AbstractEntity`

# v0.6.1
2015-07-22

## Bug Fixes
- `AbstractEntity` accepts `null` for every type
- Stored `type` instead of `value` for *internal type* properties

# v0.6.0
2015-07-22

## Features
- Added types to `AbstractEntity`
- New contracts:
 - `Arrayable`
 - `Jsonable`
 - `Makeable`
- `AbstractEntity` improvements
- Code coverage

# v0.5.0
2015-07-18

## Features
- Quality improvements
- Testing
 - `AbstractEntityTest`
 - `ApiClientTest`

# v0.4.0
2015-07-14

## Features
- Added logging to `AbstractApiClient`

# v0.3.2
2015-07-14

## Bug Fixes
- Change scope of methods in `PsrLoggerTrait`

# v0.3.1
2015-07-14

## Bug Fixes
- Fixed wrong method names in `PsrLoggerTrait`

# v0.3.0
2015-07-14

## Features
- Added `PsrLoggerTrait`

# v0.2.0
2015-07-09

## Features
- AbstractApiClient
- ApiClient

# v0.1.0
2015-07-05
- First release
