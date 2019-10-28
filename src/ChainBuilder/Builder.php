<?php

namespace ChainBuilder; 
use Exception;

class Builder {
    private $chain = null;
    private $chainLength = 0;
    private $error = "";
    private $options = [];

    public function __construct()
    {   
        // $wial = $this->checkWial($wial);
        // // TODO VALIDATE WOAL
        // $this->inputs = $wial;
    }

    public function add ($option, $parameters = null) 
    {

        if (strlen($this->chain) > 0) {
            $this->chain .= "->";
        }

        $this->chain .= "{$option["method"]}(";

        $requirements = explode("|", $option["parameters"]);

        $first = true;

        if (count($requirements) != count($parameters)) {
            $this->error .= "Bad inputs for {$option['method']}.";
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
            } else if ($requirements[$i] == "int"){
                // if (!is_int($parameters[$i])) {
                //     $type = ucfirst(gettype($parameters[$i]));
                //     $this->error = "Bad inputs for {$option['method']}. Parameter at index $i must to be {$requirements[$i]}. {$type} given.";
                //     throw new Exception($this->error, 1);    
                // }
                $this->chain .= intval($parameters[$i]);
            }
        }

        $this->chain .= ")";
        $this->chainLength += 1;

        return $this;
    }

    /**
     * Build a chain by $_GET variables.
     */
    public function build () 
    {
        $this->chain = null;
        $this->chainLength = 0;

        foreach ($this->inputs as $key => $value) {
            if (isset($this->options->getOptions()[$key])) {
                if ($this->add($this->options->getOptions()[$key], explode(',', $value)) == false) {
                    return [
                        "error" => $this->error,
                        "get_key" => $key,
                        "data_given" => $value,
                        "expected" => $this->options->getParameters($key)
                    ];
                }
            }
        }

        return $this;
    }

    public function checkWial ($wial) 
    {
        if ($wial != null) {
            $typeOfWial = gettype($wial);
        
            if ($typeOfWial == "string") {
                if (!(in_array($wial, ["GET", "POST"]))) {
                    throw new \Exception("You are using string as wial variable. It can be 'GET' or 'POST'", 1);
                } else {
                    return $GLOBALS["_" . $wial];
                }
            } else if ($typeOfWial != "array") {
                throw new \Exception("The wial can be an array or a string ('GET' or 'POST')", 1);
            }

            return $wial;
        }
    }

    /**
     * Get the chain.
     *
     * @return Array An array with chain as string, chain length and get keys/values. 
     */
    public function getChain () 
    {
        return [
            "chain" => $this->chain,
            "chainLength" => $this->chainLength,
            "inputs" => $this->inputs,
            "error" => $this->error
        ];
    }

    /**
     * This method allow you to use options. 
     * TODO Add a validation flow.
     * FIXME  Add multiple arrays.
     * TODO use Collector or Options -> instanceof
     *
     * @param [type] $new_options
     * @return void
     */
    public function use ($newOptions) 
    {
        $this->options = $newOptions;
        
        return $this;
    }

    public function setWial ($wial) 
    {
        $this->inputs = $this->checkWial($wial);
        
        uksort($this->inputs, function ($a, $b) {
            if ($a == $b) {
                return 0;
            } else if ($this->options->getOptions()[$a]['index'] > $this->options->getOptions()[$b]['index']) {
                return 1;
            } else {
                return -1;
            }
        });

        return $this;
    }
}
