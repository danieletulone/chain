<?php

namespace Chain\Options;

use Chain\Option;
use Chain\OptionManager;

class LaravelOptions extends OptionManager
{
    /**
     * @inherited
     */
    public static function import(): void
    {
        // 4
        Option::create("sb", "sortBy")
                ->addArgument('string')
                ->addArgument('string')
                ->setIndex(4);

        // 5
        Option::create('w', 'where')
              ->addArgument('string')
              ->addArgument('string')
              ->addArgument('string')
              ->setIndex(5);
        
        Option::create('f', 'find')
              ->addArgument('string')
              ->addArgument('string')
              ->addArgument('string')
              ->setIndex(5);

        // 7
        Option::create('with', 'with')
              ->addArgument('string')
              ->setIndex(8);

        // 8
        Option::create('pg', 'paginate')
              ->addArgument('integer')
              ->setIndex(8);

        // 10
        Option::create('all', 'all')
              ->setIndex(10);

        Option::create('get', 'get')
              ->setIndex(10);
        
        // 11
        Option::create('tk', 'take')
              ->addArgument('integer')
              ->setIndex(11);

        Option::create('first', 'first')
              ->setIndex(11);
    }
}