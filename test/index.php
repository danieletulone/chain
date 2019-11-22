<?php

use Chain\Collector as ChainCollector;

require ('../vendor/autoload.php');

require ('collector/laravel.php');

echo json_encode(ChainCollector::getAll());