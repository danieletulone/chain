<?php

namespace Chain;

use Exception;

class Ford 
{
    use Singleton;

    private $options = [];

    private $chains = [];

    private $object = null;

    public function run(mixed $what = null)
    {
        if (($result = self::getInstance()->object) == null) {
            throw new Exception('You must specify the object who use current chain.');
        }

        if (is_string($what)) {
            $inputs = self::getInstance()->chains[$what]->getInputs();
        }

        $inputs = self::sortInputs($inputs);

        foreach ($inputs as $input => $values) {
            $values = array_filter(explode(',', $values), function ($i) {
                return trim($i);
            });

            if (!self::validateArguments($input, $values)) {
                throw new Exception('No valid args.');
            }

            if (is_string($result)) {
                $result = $result::{self::getMethodName($input)}(...$values);
            } else {
                $result = $result->{self::getMethodName($input)}(...$values);
            }
        }

        return $result;
    }

    private static function getMethodName($input)
    {
        return self::getInstance()->options[$input]->getMethodName();
    }

    private static function validateArguments($input, $values)
    {
        $required = self::getInstance()->options[$input]->getArguments();

        if (count($required) == count($values)) {
            return true;
        }
        
        return false;
    }

    public static function on($object)
    {
        self::getInstance()->object = $object;

        return self::getInstance();
    }

    /**
     * This method allow you to use options.
     *
     * @param [type] $new_options
     * @return void
     */
    public static function use(mixed $options): void
    {
        foreach ($options as $option) {
            self::addOption($option);
        }
    }

    public static function addOption(Option $option): Option
    {
        if (isset(self::getInstance()->options[$option->getName()])) {
            throw new Exception('Option name already in use: ' . $option->getName());
        }

        self::getInstance()->options[$option->getName()] = $option;

        return self::getInstance()->options[$option->getName()];
    }

    public static function addChain(Chain $chain): Chain
    {
        if (isset(self::getInstance()->chains[$chain->getName()])) {
            throw new Exception('Option name already in use: ' . $chain->getName());
        }

        self::getInstance()->chains[$chain->getName()] = $chain;

        return self::getInstance()->chains[$chain->getName()];
    }

    /**
     * This method sorts inputs by index given in rules.
     * The larger the index of single rule, the later the method will be concatenated.
     */
    public static function sortInputs(array $inputs = null): array
    {
        if ($inputs == null) {
            $inputs = $_GET ?? $_POST;
        }

        $instance = static::class;

        array_filter($inputs, function ($input) use ($instance) {
            return $instance::exists($input);
        });

        uksort($inputs, function ($a, $b) {
            if ($a == $b) {
                return 0;
            } else if (self::getIndex($a) > self::getIndex($b)) {
                return 1;
            } else {
                return -1;
            }
        });

        return $inputs;
    }

    /**
     * Get index of option with given name.
     *
     * @param string $name The name of option.
     * @return void
     */
    private static function getIndex(string $name)
    {
        return self::getInstance()->options[$name]->getIndex();
    }

    /**
     * Check if a option with given name exists.
     *
     * @param  string $name The name of option.
     * @return void
     */
    private static function exists(string $name)
    {
        return isset(self::getInstance()->options[$name]);
    }
}
