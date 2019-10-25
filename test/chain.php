<?php

require ('../vendor/autoload.php');
ini_set('log_errors', 1);

use ChainBuilder\Builder as ChainBuilder;
use ChainBuilder\Options\LaravelOptions;

$chainBuilder = new ChainBuilder("GET");
$laravelOptions = new LaravelOptions();
$chainBuilder->use($laravelOptions);
$chainBuilder->build();

echo json_encode($chainBuilder->getChain());