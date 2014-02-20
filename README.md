caseformat
==========
[![Build Status](https://secure.travis-ci.org/jlinn/caseformat.png?branch=master)](http://travis-ci.org/jlinn/caseformat)


A PHP case formatting tool inspired by [Google Guava](https://code.google.com/p/guava-libraries/)'s CaseFormat.

## Installation Using [Composer](http://getcomposer.org/)

Assuming composer.phar is located in your project's root directory, run the following command:

```bash
php composer.phar require jlinn/caseformat:~1.0
```

## Usage

The following case formats are supported:

| Format | Example |
|--------|---------|
| LOWER_HYPHEN | foo-bar |
| LOWER_UNDERSCORE | foo_bar |
| LOWER_CAMEL | fooBar |
| UPPER_CAMEL | FooBar |
| UPPER_UNDERSCORE | FOO_BAR |

Conversion from `LOWER_UNDERSCORE` to `UPPER_CAMEL`, for example, is done like so:
```php
use CaseFormat\CaseFormat;

$converted = CaseFormat::LOWER_UNDERSCORE("test_string")->to(CaseFormat::UPPER_CAMEL);
```
In the example above, the value of `$converted` would be `"TestString"`.