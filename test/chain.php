<?php

require ('../vendor/autoload.php');

use ChainBuilder\ChainBuilder;
use ChainBuilder\Options\LaravelOptions;

$chainBuilder = new ChainBuilder("GET");
$laravelOptions = new LaravelOptions();
$chainBuilder->setOptions($laravelOptions->getOptions());
$chainBuilder->build();

echo json_encode($chainBuilder->getChain());