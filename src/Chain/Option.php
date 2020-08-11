<?php

namespace Chain;

use Exception;

class Option
{
    private $name;

    private $methodName;

    private $arguments = [];

    private $index;

    public function __construct($name = null, $methodName = null, $index = 0)
    {
        $this->name = $name;
        $this->methodName = $methodName;
        $this->setIndex($index);
    }

    public static function create($name = null, $methodName = null, $index = 0)
    {
        $option = new Option($name, $methodName, $index);
        
        return Ford::addOption($option);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;

        return $this;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex($index)
    {
        if (is_integer($index)) {
            $this->index = intval($index);

            return $this;
        }

        throw new Exception("Error setting index of an option. $index is not a valid value for index.");
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function addArgument($type)
    {
        array_push($this->arguments, new Argument($type));

        return $this;
    }

    public function save()
    {
        Ford::addOption($this);
    }
}