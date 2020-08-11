<?php

namespace Chain;

class Argument
{
    private $type;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * Create an argument and return it.
     *
     * @param [type] $type
     * @return void
     */
    public static function create($type = null)
    {
        return new Argument($type);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}