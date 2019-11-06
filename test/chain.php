<?php

require ('../vendor/autoload.php');

// Use Builder, Collector, Options and LaravelOptions
use Chain\Builder as ChainBuilder;
use Chain\Collector as ChainCollector;
use Chain\Options as ChainOptions;
use Chain\Options\LaravelOptions;

$chainBuilder = new ChainBuilder();
$chainBuilderExample = new ChainBuilder();
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