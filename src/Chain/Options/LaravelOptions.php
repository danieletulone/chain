<?php

namespace Chain\Options;
use Chain\Options;

class LaravelOptions extends Options {

    public function setOptions () 
    {
        // 4
        $this->addOption("sb", "sortBy", "string|string", 4);
        
        // 5
        $this->addOption("w", "where", "string|string|string", 5);
        $this->addOption("f", "find", "int", 5);
        
        // 7
        $this->addOption("with", "with", "string", 8);

        // 8
        $this->addOption("pg", "paginate", "int", 8);

        // 10
        $this->addOption("all", "all", "", 10);
        $this->addOption("get", "get", "", 10);
        
        // 11
        $this->addOption("tk", "take", "int", 11);
        $this->addOption("tkf", "first", "", 11);
    }
}