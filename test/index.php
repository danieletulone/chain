<?php

use Chain\Ford;
use Chain\Option;
use Chain\Chain;

require ('../vendor/autoload.php');

class A
{
    public function sortBy($a)
    {
        echo "sortBy -> $a";

        return $this;
    }

    public function get()
    {
        echo "get <br>";

        return $this;
    }
}

$a = new A();

$sortByOption = Option::create('sb', 'sortBy', 5)->addArgument('string');

$getOption = Option::create('g', 'get');

$chain = Chain::create('base-get');

Ford::on($a)->run([
    'sb' => 'ciao',
    'g' => '',
]);