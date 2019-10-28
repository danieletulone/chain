<?php

namespace ChainBuilder\Options;
use ChainBuilder\Options;

class LaravelOptions extends Options {

    public function setOptions () 
    {
        $this->addOption("all", "all", "", 10);
        $this->addOption("get", "get", "", 10);
        $this->addOption("pg", "paginate", "int", 6);
        $this->addOption("sb", "sortBy", "string|string", 4);
        $this->addOption("tk", "take", "int", 11);
        $this->addOption("w", "where", "string|string|string", 5);
    }
}