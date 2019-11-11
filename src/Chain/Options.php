<?php

namespace Chain;

/**
 * This class rappresents a collections of options. 
 * It will be used with Chain\Builder class.
 */
class Options {
    protected $options = [];

    public function __construct () {
        $this->setOptions();
    }

    /**
     * This method add an option.
     * 
     * @return void
     */
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

    /**
     * This method get parameters of option with short value given.
     */
    public function getParameters ($short) {
        return $this->options[$short]["parameters"];
    }
    
    /**
     * This method return all options as array.
     * 
     * @return Array array as options.
     */
    public function getOptions () {
        return $this->options;
    }

    /**
     * This methods is used to set options.
     * 
     * @return void
     */
    public function setOptions () {}
}