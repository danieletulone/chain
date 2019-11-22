<?php 

namespace Chain;

use Chain\Builder;

/**
 * This class is collector of built chains.
 * @author Daniele Tulone
 */
class Collector 
{

    /**
     * This array contains all built chains.
     * @access private
     */
    private static $chains = [];

    /**
     * The instance. This class is a singleton.
     * @access private
     */
    private static $instance = null;

    /**
     * This is an associative array that contains name => function of chain to built and match.
     */
    private static $preChains = [];

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Add a build chain with given name. 
     * The chain will be added by given function.
     * 
     * @param string name is the name of chain
     * @param function func the function that build the chain.
     */
    public static function add ($name, $func) 
    {
        self::$preChains[$name] = $func;
    }

    /**
     * Build and give all chains.
     * 
     * @return array An associative array with all built chains.
     */
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

    /**
     * Get the variables for matcher. Not in use yet.
     */
    public static function getVariables ($string) 
    {
        $variables = null;
        \preg_match_all("/{(.*)}/", $string, $variables);

        print_r($variables);
        exit(1);
    }
}