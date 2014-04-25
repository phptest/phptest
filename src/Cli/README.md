# PHPTest CLI

**Master build:** [![Master branch build status][travis-master]][travis]<br/>
**Requires:** `PHP >= 5.4 || HHVM >= 3.0`

**PHPTest** CLI is a small application factory built around the popular
[Symfony Console][symfony-console] library and
[PHPTest Service Container][phptest-sc].

It can be installed in whichever way you prefer, but I recommend
[Composer][packagist].
```json
{
    "require": {
        "phptest/cli": "*"
    }
}
```

### Contributing
All contributions, including issues, comments and pull requests should be made
to the main [phptest/phptest][phptest] respository.

### License
The content of this library is released under the **MIT License** by
**Andrew Lawson**.<br/> You can find a copy of this license in
[`LICENSE`][license] or at http://opensource.org/licenses/mit.

[travis]: https://travis-ci.org/phptest/phptest
[travis-master]: https://travis-ci.org/phptest/phptest.png?branch=master
[packagist]: https://packagist.org/packages/phptest/phptest
[license]: /LICENSE
[phptest]: https://github.com/phptest/phptest
[phptest-sc]: https://github.com/phptest/service-container
[symfony-di]: https://github.com/symfony/Console
