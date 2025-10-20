## PAL: PHP Animation Library.

PAL: PHP Animation Library for DOM elements with CSS3 animations, 3D effects, and fluent API.

[![Tests](https://github.com/cloverphp/clover/actions/workflows/tests.yml/badge.svg)](https://github.com/cloverphp/clover/actions/workflows/tests.yml)
![Packagist Version](https://img.shields.io/packagist/v/cloverphp/clover?style=flat&logo=composer&logoColor=%23fff)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cloverphp/clover/php?style=flat&logo=php&logoColor=blue&label=PHP&color=blue)
![Packagist License](https://img.shields.io/packagist/l/cloverphp/clover?style=flat&label=License&color=blue)
![Packagist Downloads](https://img.shields.io/packagist/dt/cloverphp/clover?style=flat&logo=packagist&label=Downloads&color=blue)
![Packagist Stars](https://img.shields.io/packagist/stars/cloverphp/clover?style=flat&logo=github&logoColor=%23ffffff&label=%F0%9F%8C%9F%20Stars)

---

### Install

```bash
composer require pal/pal
```

### Example

```php
<?php
require 'vendor/autoload.php';
use PAL\PAL;

echo PAL::create('button')
    ->text('Hello PAL!')
    ->background()->color('#3498db')
    ->color('#fff')
    ->animate('bounce','1s','infinite','hover')
    ->render();
```
