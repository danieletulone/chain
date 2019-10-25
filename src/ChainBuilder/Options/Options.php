<?php

namespace ChainBuilder\Options;

class Options {
    protected $options = [];

    public function __construct () {
        $this->setOptions();
    }

    // TODO ADD ORDER PRIORITY
    // TODO 
    public function addOption ($short, $methodName, $parameters = "", $ovveride = false) {
        if ($ovveride == false) {
            if (isset($this->options[$short])) {
                throw new \Exception("Can not ovveride option called $short.", 1);
            }
        }

        $this->options[$short] = [
            "method" => $methodName,
            "parameters" => $parameters
        ];
    }

    public function getParameters ($short) {
        return $this->options[$short]["parameters"];
    }
    
    public function getOptions () {
        return $this->options;
    }

    public function setOptions () {}
}