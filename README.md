# Sainsbury's Web Scraper

[![Build Status](http://ci.rebelinblue.com/build-status/image/4?branch=master&style=flat&label=PHPCI)](http://ci.rebelinblue.com/build-status/view/4?branch=master)
[![Code Climate](https://codeclimate.com/github/REBELinBLUE/sainsburys/badges/gpa.svg)](https://codeclimate.com/github/REBELinBLUE/sainsburys)
[![Test Coverage](https://codeclimate.com/github/REBELinBLUE/sainsburys/badges/coverage.svg)](https://codeclimate.com/github/REBELinBLUE/sainsburys/coverage)

## Assumptions

This guide assumes that [composer](https://getcomposer.org/) is installed in `$PATH`

## Dependencies

The tool has the following system dependencies

 * [PHP](http://www.php.net) 5.5.9+ or newer with the cURL & JSON extensions
 
It also relies 2 external PHP libaries

 * [symfony/console](https://github.com/symfony/console) for providing the command line interface
 * [fabpot/goutte](https://github.com/FriendsOfPHP/Goutte) for parsing pages

## Installation


1. Clone the repository

    ```shell
    $ git clone https://github.com/REBELinBLUE/sainsburys
    ```

2. Checkout the latest release

    ```shell
    $ git checkout 1.0.0
    ```

3. Install the dependencies

    ```shell
    $ composer install -o --no-dev
    ```

## Running

The application can be run as follows

    $ php console scrape $URL
    
Where `$URL` is the URL to scrape.

The command also allows for the JSON output to be formatted, using the `--pretty` option, for example

	$ php console scrape $URL --pretty
	
Additional debugging information can be output using `--verbose`, for example

	$ php console scrape $URL --pretty --verbose
	
So, to get the output for the URL listed in the test, the following command would be run

	$ php console scrape http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html --pretty


## Testing

### Dependencies

During development & testing there are several additional dependencies

 * [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) for unit testing
 * [squizlabs/php_codesniffer](https://github.com/squizlabs/php_codesniffer) for checking code formatting
 * [phpmd/phpmd](https://github.com/phpmd/phpmd) for testing for code smell
 * [block8/php-docblock-checker](https://github.com/block8/php-docblock-checker) to ensure no PHPDoc blocks is missing 
 * [phpcpd/phpcpd](https://github.com/sebastianbergmann/phpcpd) to ensure there is no code duplication
 * [phploc/phploc](https://github.com/sebastianbergmann/phploc) to generate "Lines of Code" data
 * [codeclimate/php-test-reporter](https://github.com/codeclimate/php-test-reporter) to send the test coverage report to Codeclimate

These can be installed with

    $ composer install

### Unit Testing

There are unit tests included which use PHPUnit, they can be run with the following

    $ ./vendor/bin/phpunit

It is possible to customise the PHPUnit configuration by copying `phpunit.xml.dist` to `phpunit.xml` and modifying it as desired.

### Coding Standards

The code is written to follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) standards, this can be tested using PHP_CodeSniffer

    $ ./vendor/bin/phpcs --standard=PSR2 src/ tests/

Mess can be checked with

    $ ./vendor/bin/phpmd src/,tests/ text cleancode,codesize,design,naming,unusedcode

Duplication can be checked with

    $ ./vendor/bin/phpcpd src/ tests/

PHPDoc blocks can be checked with

    $ ./vendor/bin/phpdoccheck --directory=. --exclude=vendor

These tests are run automatically on push using [PHPCI](http://phptesting.org)