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
        ->setWoal([
            "sb" => "id,DESC", 
            "pg" => "15", 
            "get" => ""
        ])->build();
});

Collector::add("larger-pagination", function () use ($chainBuilder) {
    return $chainBuilder
        ->setWoal([
            "sb" => "id,DESC", 
            "pg" => "50", 
            "get" => ""
        ])->build();
});

echo json_encode($collector->getAll());