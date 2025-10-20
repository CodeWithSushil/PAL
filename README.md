## PAL: PHP Animation Library.

PAL: PHP Animation Library for DOM elements with CSS3 animations, 3D effects, and fluent API.

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
