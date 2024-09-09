<?php

declare (strict_types=1);

function dd($args){
    echo "<pre>";
    var_dump($args);
    echo "</pre>";
    die();
 }

 function getAds() {
    return(new \App\Ads())->getAds();
    
 }