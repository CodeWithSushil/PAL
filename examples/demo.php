<?php
require '../src/Pal/PAL.php';
use PAL\PAL;

echo PAL::create('button')
    ->text('3D Bounce!')
    ->background()->color('#e67e22')
    ->color('#fff')
    ->transition('0.5s ease')
    ->transform('perspective(600px) rotateY(0deg)','default')
    ->transform('perspective(600px) rotateY(15deg) scale(1.1)','hover')
    ->animate('bounce','1s','infinite','hover')
    ->render();
