<?php 

namespace Chain;

use Chain\Builder;

class Collector {
    private static $chains = [];
    private static $preChains = [];
    private static $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return $instance;
    }

    public static function add ($name, $func) 
    {
        self::$preChains[$name] = $func;
    }

    public static function getAll () 
    {   
        foreach (self::$preChains as $name => $preChain) {
            $chainBuilt = $preChain();
            if (is_a($chainBuilt, 'Chain\Builder', true)) {
                self::$chains[$name] = $chainBuilt->getChain();
            } else {
                throw new \Exception("The given callback doesn't return a instance of Chain\Builder.", 1);
            }
        }

        return self::$chains;
    }

    public static function getVariables ($string) {
        $variables = null;
        \preg_match_all("/{(.*)}/", $string, $variables);

        print_r($variables);
        exit(1);
    }
}