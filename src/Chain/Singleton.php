<?php

namespace Chain;

trait Singleton
{
    private static $instance = null;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}