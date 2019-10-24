<?php

namespace ChainBuilder;

class ChainBuilder {
    private $chain = null;
    private $chainLength = 0;
    private $options = [];
    private $error = "";

    public function __construct($woal)
    {   
        $typeOfWoal = gettype($woal);
        
        if ($typeOfWoal == "string") {
            if (!(in_array($woal, ["GET", "POST"]))) {
                throw new \Exception("You are using string as woal variable. It can be 'GET' or 'POST'", 1);
            } else {
                $woal = $GLOBALS["_" . $woal];
            }
        } else if ($typeOfWoal != "array") {
            throw new \Exception("The woal can be an array or a string ('GET' or 'POST')", 1);
        }

        $this->inputs = $woal;
    }

    public function add ($option, $parameters = null) {
        if (strlen($this->chain) > 0) {
            $this->chain .= "->";
        }

        $this->chain .= $option["method"] . "(";

        $requirements = explode("|", $option["parameters"]);

        $first = true;

        if (count($requirements) != count($parameters)) {
            $this->error .= "Bad inputs for " . $option['method'] . ".";
            return false;
        }

        for ($i = 0; $i < count($parameters); $i++) {
            if ($first) {
                $first = false;
            } else {
                $this->chain .= ", ";
            }

            if ($requirements[$i] == "string") {
                $this->chain .= "'" . $parameters[$i] . "'";
            } else {
                $this->chain .= $parameters[$i];
            }
        }

        $this->chain .= ")";
        $this->chainLength += 1;

        return $this;
    }

    /**
     * Build a chain by $_GET variables.
     */
    public function build () {

        foreach ($this->inputs as $key => $value) {
            if (isset($this->options[$key])) {
                if ($this->add($this->options[$key], explode(',', $value)) == false) {
                    return [
                        "error" => $this->error,
                        "get_key" => $key,
                        "data_given" => $_GET[$key],
                        "expected" => $this->options[$key]
                    ];
                }
            }
        }

        return $this->getChain();
    }

    /**
     * Get the chain.
     *
     * @return Array An array with chain as string, chain length and get keys/values. 
     */
    public function getChain () {
        return [
            "chain" => $this->chain,
            "chainLength" => $this->chainLength,
            "inputs" => $this->inputs,
        ];
    }

    /**
     * This method allow you to set options. 
     * TODO Add a validation flow.
     *
     * @param [type] $new_options
     * @return void
     */
    public function setOptions ($newOptions) {
        if (is_array($newOptions)) {
            $this->options = $newOptions;
            return true;
        }

        return false;
    }
}
