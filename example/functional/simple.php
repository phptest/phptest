<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\example\functional;

suite('suite name', function () {

    test('test name', function () {
        // test something
    });

    suite('nested suite', function () {

        test('nested test', function () {
            // test something
        });

        test('nested test with args', function ($arg) {
            // each args array creates a separate test
        }, [['foo'], ['bar']]);

    });

});
