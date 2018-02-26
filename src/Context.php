<?php

/**
 * This file is part of the SContext package.
 *
 * (c) Petr Saganov <saganoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Context;

class Context implements ContextInterface
{
    private $items;
    private $driver;
    private $cast_functions;
    public function __construct(ContextDriverInterface $driver){
        $this->driver = $driver;
        $this->cast_functions = [
            'string'  => function($v){return (string)$v;},
            'integer' => function($v){return (int)$v;},
            'boolean' => function($v){return (bool)$v;},
        ];
    }
    public function add($key, $default = null, $castFunction = 'string'){
        if (is_callable($castFunction)){
            $hash = hash('sha256', (string)new \ReflectionFunction($castFunction));
            $this->cast_functions[$hash] = $castFunction;
            $castFunction = $hash;
        } elseif (!key_exists($castFunction, $this->cast_functions)){
            throw new InvalidCastFunctionException("Invalid cast function: '$castFunction'");
        }
        $this->items[$key] = array('default' => $default, 'cast' => $castFunction);
        return $this;
    }
    public function get($key, $default = null){
        if (key_exists($key, $this->items)){
            $value = $this->driver->get($key, $this->items[$key]['default']);
            if (self::REQUIRED_KEY === $value) throw new RequiredKeyException("Required context key: '{$key}' left unset");
            $cast = $this->items[$key]['cast'];
            return $this->cast_functions[$cast]($value);
        } else {
            throw new UnknownKeyException("Unknown context key: '{$key}' has requested");
        }
    }
}

class RequiredKeyException extends \Exception{}
class UnknownKeyException extends \Exception{}
class InvalidCastFunctionException extends \Exception{}
