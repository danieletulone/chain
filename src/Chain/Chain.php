<?php

namespace Chain;

class Chain
{
    private $name;

    private $inputs = [];

    public function __construct(string $name, array $inputs)
    {
        $this->name = $name;
        $this->inputs = $inputs;
    }

    public static function create(string $name, array $inputs)
    {
        $chain = new Chain($name, $inputs);
        
        return Ford::addChain($chain, $inputs);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getInputs()
    {
        return $this->inputs;
    }

    public function addOption(array $input)
    {
        array_push($this->inputs, $input); 
    }
}