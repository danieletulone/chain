<?php

require ('../vendor/autoload.php');

use Chain\Builder as ChainBuilder;
use Chain\Options\LaravelOptions;
use Chain\Collector as ChainCollector;

$chainBuilder = new ChainBuilder();
$laravelOptions = new LaravelOptions();
$chainBuilder->use($laravelOptions);

ChainCollector::add("default-pagination", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWial([
            "sb" => "id,DESC", 
            "get" => "",
            "pg" => "15" 
        ])->build();
});

ChainCollector::add("larger-pagination", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWial([
            "sb" => "id,DESC", 
            "pg" => "50", 
            "get" => ""
        ])->build();
});

echo json_encode(ChainCollector::getAll());