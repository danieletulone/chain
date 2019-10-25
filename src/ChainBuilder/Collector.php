<?php 

namespace ChainBuilder;

class Collector {
    private $chains = [];
    
    public function __constructor () 
    {
        //
    }

    public function add ($name, $chainBuilded) 
    {
        $this->chains[$name] = $chainBuilded;
    }

    public function getAll () 
    {
        return $this->chains;
    }
}