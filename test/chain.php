<?php

require ('../vendor/autoload.php');

use ChainBuilder\Builder as ChainBuilder;
use ChainBuilder\Options\LaravelOptions;
use ChainBuilder\Collector as ChainCollector;

$chainBuilder = new ChainBuilder("GET");
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

// Collector::add("take-first-{id}", function ($id) use ($chainBuilder) {
//     return $chainBuilder
//         ->setWial([
//             "tk" => 1,
//             "w" => "id,=,$id",
//         ])->build();
// });

echo json_encode(ChainCollector::getAll());