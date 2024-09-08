<?php

declare(strict_types=1);



require 'bootstrap.php';

$ads = new \App\Ads();

$ads->createAds('Now', 'How', 2, 1,1, 'Navoiy', 100, 2);