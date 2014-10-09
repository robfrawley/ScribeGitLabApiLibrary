# GitLab API Bundle

[![Build Status](https://img.shields.io/travis/scribenet/ScribeGitLabApiLibrary/master.svg?style=flat-square)](https://travis-ci.org/scribenet/ScribeGitLabApiLibrary)
[![Quality Score](http://img.shields.io/codeclimate/coverage/github/scribenet/ScribeGitLabApiLibrary.svg?style=flat-square)](https://codeclimate.com/github/scribenet/ScribeGitLabApiLibrary)
[![Coverage Status](http://img.shields.io/coveralls/scribenet/ScribeGitLabApiLibrary.svg?style=flat-square)](https://codeclimate.com/github/scribenet/ScribeGitLabApiLibrary)
[![Dependency Status](http://img.shields.io/gemnasium/scribenet/ScribeGitLabApiLibrary.svg?style=flat-square)](https://gemnasium.com/scribenet/ScribeGitLabApiLibrary)
[![Latest Version](http://img.shields.io/packagist/v/scribe/gitlab-api-library.svg?style=flat-square)](https://packagist.org/packages/scribe/gitlab-api-library)
[![Software License](http://img.shields.io/packagist/l/scribe/gitlab-api-library.svg?style=flat-square)](LICENSE.md)

This is a simple, object oriented PHP5 client for [GitLab's API](https://github.com/gitlabhq/gitlabhq/tree/master/doc/api), implemented with an intentionally similar API to GitLab's native RESTful API.

## Features

* **Code Standards**: Implements [PSR-0](http://www.php-fig.org/psr/psr-0/) code and structure standards to accommodate auto-loading using [Composer](https://getcomposer.org/) or another class auto-loading solution.
* **Speed and Familiarity**: Lightweight, fast, and friendly object model utilizing lazy loading with an intentional similarly to GitLab's own RESTful API.
* **Tests and Continuous Integration**: Extensive [PHPUnit](https://phpunit.de/) tests utilizing [Travis CI](https://travis-ci.org/scribenet/ScribeGitLabApiLibrary) as our continuous integration service.
* **Quality, Coverage and Dependencies**: Code quality reports with [Code Climate](https://codeclimate.com/github/scribenet/ScribeGitLabApiLibrary), coverage reports with [Coveralls](https://coveralls.io/r/scribenet/ScribeGitLabApiLibrary), and dependency version monitoring using [Gemnasium](https://gemnasium.com/scribenet/ScribeGitLabApiLibrary).
* **Documentation and Examples**: Comprehensive [examples](doc/) written in markdown and automatically generated [API documentationn](https://scribenet.github.io/ScribeGitLabApiLibrary/).

## Requirements

This library requires a short list of dependencies for both a production installation or a development build.

### Production

* PHP >= [5.5](http://php.net/manual/en/migration55.changes.php) or [HHVM](http://hhvm.com/)
* The [Curl](http://php.net/manual/en/book.curl.php) extension
* The [Guzzle](https://github.com/guzzle/guzzle) [HTTP request framework](http://docs.guzzlephp.org/en/latest/)
* The [Buzz](https://github.com/kriswallsmith/Buzz) HTTP request framework until the conversion to Gizzle is complete. 

### Development

* [PHPUnit](https://phpunit.de/) >= 4.0
* [Coveralls Reporter](https://github.com/satooshi/php-coveralls) >= 0.6.1
* [Code Climate Reporter](https://github.com/codeclimate/php-test-reporter) >= 0.1.2
* [Sami](https://github.com/fabpot/sami) >= 2.0

## Installation

This library can be included into your project easily using [Composer](http://getcomposer.org) by adding the dependency to the `require` section of your `composer.json` project file.

```json
{
    "require": {
        "scribe/gitlab-api-library": "dev-master"
    }
}
```

## Usage

```php
<?php

require_once 'vendor/autoload.php';

$client = new \Gitlab\Client('http://git.yourdomain.com/api/v3/');
$client->authenticate('your_gitlab_token_here', \Gitlab\Client::AUTH_URL_TOKEN);
```

## Documentation

For general usage and examples, you can check the [doc](doc/) directory. For a comprehensive API reference, check this project's [github.io webpage](https://scribenet.github.io/ScribeGitLabApiLibrary/).

## Contributors

This project has code contributed from an [array of individuals](https://github.com/scribenet/ScribeGitLabApiLibrary/graphs/contributors).