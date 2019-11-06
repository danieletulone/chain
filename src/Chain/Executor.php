<?php

namespace Chain;

class Executor {
    /**
     * A recursive method to run a chain by string
     *
     * @param Object $obj A valid instance of any class.
     * @param Array $chain An array of methods to run.
     * @return mixed The result of last run method.
     */
    public static function execute ($obj, $chain) {
        if (count($chain) == 0) {
            return $obj;
        } else {
            $explosion = explode("(", $chain[0]);
            $method = $explosion[0];
            $parameters = $explosion[1];

            if (strlen($parameters) > 1) {
                $parameters = explode(",", substr($parameters, 0, -1));
            } else {
                $parameters = [];
            }

            $new_parameters = [];

            foreach ($parameters as $param) {
                trim($param);

                if (strpos($param, "'") === false) {
                    $param = (int) $param;
                } else {
                    $param = trim(str_replace("'", "", $param));
                }

                array_push($new_parameters, $param);
            }

            array_shift($chain);

            return ChainExecutor::execute($obj->{$method}(...$new_parameters), $chain);
        }
    }

    /**
     * This method split a chain in array.
     */
    public static function split ($chain_as_string) {
        return preg_split('{->|::}', $chain_as_string);
    }
}
