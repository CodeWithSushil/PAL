## PAL: PHP Animation Library.

PAL: PHP Animation Library for DOM elements with CSS3 animations, 3D effects, and fluent API.

![Packagist Version](https://img.shields.io/packagist/v/pal/pal?style=flat&logo=composer&logoColor=%23fff)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/pal/pal/php?style=flat&logo=php&logoColor=blue&label=PHP&color=blue)
![Packagist License](https://img.shields.io/packagist/l/pal/pal?style=flat&label=License&color=blue)
![Packagist Downloads](https://img.shields.io/packagist/dt/pal/pal?style=flat&logo=packagist&label=Downloads&color=blue)

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
