<?php

require ('../vendor/autoload.php');

use ChainBuilder\ChainBuilder;
use ChainBuilder\Options\LaravelOptions;

$chainBuilder = new ChainBuilder();
$laravelOptions = new LaravelOptions();
$chainBuilder->setOptions($laravelOptions->options);
$chainBuilder->fromGet();

echo json_encode($chainBuilder->getChain());