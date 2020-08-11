<?php

namespace Chain;

/**
 * This class rappresents a collections of options. 
 * It will be used with Chain\Ford class.
 */
abstract class OptionManager
{    
    /**
     * This methods is used to set options.
     * 
     * @return void
     */
    abstract public static function import(): void;
}