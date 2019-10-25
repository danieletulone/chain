<?php

require ('../vendor/autoload.php');

use ChainBuilder\Builder as ChainBuilder;
use ChainBuilder\Options\LaravelOptions;
use ChainBuilder\Collector;

$chainBuilder = new ChainBuilder("GET");
$laravelOptions = new LaravelOptions();
$chainBuilder->use($laravelOptions);

$collector = new Collector();
$collector->add("from-get", $chainBuilder->build());

$collector->add("default-pagination", $chainBuilder->setWoal(["pg" => "15a", "get" => ""])->build());

echo json_encode($collector->getAll());