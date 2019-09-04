<?php

namespace ChainBuilder;

class ChainBuilder {

    /**
     * This array rappresent the availables options when create chain from get.
     *
     * @var array
     */
    private $options = [];

    public function __construct()
    {
        $this->chain = "";
        $this->chain_length = 0;
        $this->error = "";
        $this->inputs = $_GET;
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
        $this->chain_length += 1;

        return $this;
    }

    /**
     * Build a chain by $_GET variables.
     */
    public function fromGet () {

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
            "chain_length" => $this->chain_length,
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
    public function setOptions ($new_options) {
        if (isArray($new_options)) {
            $this->options = $new_options;
            return true;
        }

        return false;
    }
}
