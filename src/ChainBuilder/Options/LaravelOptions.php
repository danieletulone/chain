<?php

namespace ChainBuilder\Options;

class LaravelOptions extends Options{
    public $options = [
        "all" => [
            "method" => "all",
            "parameters" => ""
        ],
        "get" => [
            "method" => "get",
            "parameters" => ""
        ],
        "pg" => [
            "method" => "paginate",
            "parameters" => "int"
        ],
        "sb" => [
            "method" => "sortBy",
            "parameters" => "string|string"
        ],
        "tk" => [
            "method" => "take",
            "parameters" => "int"
        ],
        "w" => [
            "method" => "where",
            "parameters" => "string|string|string"
        ],
    ];
}