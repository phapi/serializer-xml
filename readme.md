# XML Serializer

[![Build status](https://img.shields.io/travis/phapi/serializer-xml.svg?style=flat-square)](https://travis-ci.org/phapi/serializer-xml)
[![Code Climate](https://img.shields.io/codeclimate/github/phapi/serializer-xml.svg?style=flat-square)](https://codeclimate.com/github/phapi/serializer-xml)
[![Test Coverage](https://img.shields.io/codeclimate/coverage/github/phapi/serializer-xml.svg?style=flat-square)](https://codeclimate.com/github/phapi/serializer-xml/coverage)

The XML Serializer package contains two middleware, one for serialization and one for deserialization. The two works the same the only difference is that the serializer takes an array and returns XML and the deserializer does the opposite.

The serializer reacts if the <code>Accept</code> header matches one of the supported mime types and the deserializer reacts if the <code>Content-Type</code> matches the list of supported mime types.

By default the supported mime types are: <code>application/xml</code>. It is possible to add more mime types by passing an array to the constructor.


## Installation
This middleware is **not** included by default in the [Phapi Framework](https://github.com/phapi/phapi-framework) but if you need to install it it's available to install via [Packagist](https://packagist.org) and [Composer](https://getcomposer.org).

```shell
$ php composer.phar require phapi/serializer-xml:1.*
```

## Configuration
Both the serializer and deserializer has one configuration option, it's possible to add more mime types that should trigger the serializer/deserializer.

```php
<?php
use Phapi\Middleware\Serializer\Xml\Xml;

$pipeline->pipe(new Xml(['text/html']));
```

Note that the array passed to the constructor will be merged with the default settings.

The above instructions applies to the deserializer as well.

See the [configuration documentation](http://phapi.github.io/docs/started/configuration/) for more information about how to configure the integration with the Phapi Framework.

## Phapi
This middleware is a Phapi package used by the [Phapi Framework](https://github.com/phapi/phapi-framework). The middleware are also [PSR-7](https://github.com/php-fig/http-message) compliant and implements the [Phapi Middleware Contract](https://github.com/phapi/contract).

## License
Serializer XML is licensed under the MIT License - see the [license.md](https://github.com/phapi/serializer-xml/blob/master/license.md) file for details

## Contribute
Contribution, bug fixes etc are [always welcome](https://github.com/phapi/serializer-xml/issues/new).
