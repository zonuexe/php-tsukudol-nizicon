Tsukudol\Nizicon
================

[![Build Status](https://travis-ci.org/zonuexe/php-tsukudol-nizicon.svg)](https://travis-ci.org/zonuexe/php-tsukudol-nizicon)
[![Downloads this Month](https://img.shields.io/packagist/dm/zonuexe/tsukudol-nizicon.svg?style=flat)](https://packagist.org/packages/zonuexe/tsukudol-nizicon)

Description
-----------

*Niji No Conquistador* (虹のコンキスタドール) implementation on PHP.

* Perl: [Acme-2zicon - metacpan.org](https://metacpan.org/release/Acme-2zicon) (GitHub: [catatsuy/acme-2zicon](https://github.com/catatsuy/acme-2zicon))
* Ruby: [rzicon - RubyGems.org](https://rubygems.org/gems/rzicon) (GitHub: [bash0C7/rzicon](https://github.com/bash0C7/rzicon))

Requirements
------------

* PHP (5.4+)

Usage
-----

```php
<?php

use Tsukudol\Nizicon;

array_map(
    function ($member) {
        echo $member->names->getNameIn('en') . PHP_EOL;
    },
    Nizicon::members()
);
```

API
---

* `Tsukudol\Nizicon::members()`
* `Tsukudol\Nizicon::member($name)`

Reference
---------

* http://pixiv-pro.com/2zicon/profile

Copyright
---------

> Niji No Conquistador on PHP
>
> Copyright (c) 2014 USAMI Kenta
