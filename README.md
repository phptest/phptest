# PHPTest

**Master build:** [![Master branch build status][travis-master]][travis]<br/>
**Requires:** `PHP >= 5.4 || HHVM >= 3.0`

**Note:** This is a work in progress. Contributions through feature requests or
pull requests are most welcome.

**PHPTest** is a test framework for PHP, written in the same vein as PHPUnit,
SimpleTest, et al. No assumptions are made as to whether you're writing pure
unit tests, functional tests, integration tests, or other. There are also no
assumptions about the format of the tests, whether they're written in classic
PHPUnit style, functional, or other.

The main effort of this library is to make testing easy to write, quick to run
and simple to integrate with your development and deployment process, while
allowing extensibility through extensions and events.

It can be installed in whichever way you prefer, but I recommend
[Composer][packagist].
```json
{
    "require-dev": {
        "phptest/phptest": "*"
    }
}
```

### Contributing
Contributions are accepted via Pull Request, but passing unit tests must be
included before it will be considered for merge. *Tests are currently run
through PHPUnit and will be updated when PHPTest is more stable.*
```bash
$ curl -O https://raw.github.com/phptest/vagrant/master/Vagrantfile
$ vagrant up
$ vagrant ssh
...

$ cd /srv
$ composer install --dev
$ vendor/bin/phpunit test
```

### License
The content of this library is released under the **MIT License** by
**Andrew Lawson**.<br/> You can find a copy of this license in
[`LICENSE`][license] or at http://opensource.org/licenses/mit.

[travis]: https://travis-ci.org/phptest/phptest
[travis-master]: https://travis-ci.org/phptest/phptest.png?branch=master
[packagist]: https://packagist.org/packages/phptest/phptest
[license]: /LICENSE
