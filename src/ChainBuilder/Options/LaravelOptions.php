<?php

namespace ChainBuilder\Options;
use ChainBuilder\Options;

class LaravelOptions extends Options {

    public function setOptions () 
    {
        $this->addOption("all", "all");
        $this->addOption("get", "get", "", 10);
        $this->addOption("pg", "paginate", "int");
        $this->addOption("sb", "sortBy", "string|string");
        $this->addOption("tk", "take", "int");
        $this->addOption("w", "where", "string|string|string");
    }
}