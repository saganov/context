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
    private $driver;
    private $items;
    public function __construct(ContextDriverInterface $driver, Array $items = []){
        $this->driver = $driver;
        $this->items = $items;
    }

    public function add($key, $default = null, $castFunction = null){
        if (is_null($castFunction)){
            $castFunction = function($value){return (string) $value;};
        }
        $this->items[$key] = array('default' => $default, 'cast' => $castFunction);
        return $this;
    }

    public function get($key){
        if (key_exists($key, $this->items)){
            $value = $this->driver->get($key, $this->items[$key]['default']);
            if (is_null($value)) throw new RequiredKeyException("Required context key: '{$key}' left unset");
            return $this->items[$key]['cast']($value);
        } else {
            throw new UnknownKeyException("Unknown context key: '{$key}' has requested");
        }
    }
}

class RequiredKeyException extends \Exception{}
class UnknownKeyException extends \Exception{}