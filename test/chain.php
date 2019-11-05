<?php

require ('../vendor/autoload.php');

use ChainBuilder\Builder as ChainBuilder;
use ChainBuilder\Options\LaravelOptions;
use ChainBuilder\Collector;

$chainBuilder = new ChainBuilder("GET");
$laravelOptions = new LaravelOptions();
$chainBuilder->use($laravelOptions);

$collector = new Collector();

Collector::add("default-pagination", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWial([
            "sb" => "id,DESC", 
            "get" => "",
            "pg" => "15" 
        ])->build();
});

Collector::add("larger-pagination", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWial([
            "sb" => "id,DESC", 
            "pg" => "50", 
            "get" => ""
        ])->build();
});

Collector::add("take-first", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWial([
            "tk" => 1,
            "w" => "id,=,$id",
        ])->build();
});

echo json_encode($collector->getAll());