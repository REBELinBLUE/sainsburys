# Sainsbury's Web Scraper

[![Build Status](http://ci.rebelinblue.com/build-status/image/4?branch=master&style=flat&label=PHPCI)](http://ci.rebelinblue.com/build-status/view/4?branch=master)

### Assumptions

This guide assumes that [composer](https://getcomposer.org/) is installed in `$PATH`

## Requirements

- [PHP](http://www.php.net) 5.5.9+ or newer


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

## Dependencies

It has two external dependencies:

 * [symfony/console](https://github.com/symfony/console) for providing the command line interface
 * [fabpot/goutte](https://github.com/FriendsOfPHP/Goutte) for parsing pages

### Development

During development there are several additional dependencies

 * [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) for unit testing
 * [squizlabs/php_codesniffer](https://github.com/squizlabs/php_codesniffer) for checking code formatting
 * [phpmd/phpmd](https://github.com/phpmd/phpmd) for testing for code smell

These can be installed with

    $ composer install

## Testing

### Coding Standards

The code is written to follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) standards, this can be tested using PHP_CodeSniffer

    $ ./vendor/bin/phpcs --standard=PSR2 src/
