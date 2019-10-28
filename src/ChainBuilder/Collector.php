<?php 

namespace ChainBuilder;

use ChainBuilder\Builder;

class Collector {
    private static $chains = [];
    private static $instance = null;

    private function __constructor () 
    {
        //    
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return $instance;
    }

    public static function add ($name, $func) 
    {
        $chainBuilded = $func();

        if (is_a($chainBuilded, 'ChainBuilder\Builder', true)) {
            self::$chains[$name] = $chainBuilded->getChain();
        } else {
            throw new \Exception("The given callback doesn't return a instance of ChainBuilder\Builder.", 1);
        }
    }

    public function getAll () 
    {
        return self::$chains;
    }
}