<?php

namespace Chain;

class Options {
    protected $options = [];

    public function __construct () {
        $this->setOptions();
    }

    public function addOption ($short, $methodName, $parameters = "", $index = 0, $ovveride = false) {
        if ($ovveride == false) {
            if (isset($this->options[$short])) {
                throw new \Exception("Can not ovveride option called $short.", 1);
            }
        }

        $this->options[$short] = [
            "method" => $methodName,
            "parameters" => $parameters,
            "index" => $index
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