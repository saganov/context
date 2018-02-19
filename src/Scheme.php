<?php

namespace Context;

class Scheme implements IScheme
{
    private $items;
    public function __construct(Array $items = []){
        $this->items = $items;
    }

    public function add($key, $default, $castFunction = null){
        if (is_null($castFunction)){
            $castFunction = function($value){return (string) $value;};
        }
        $this->items[$key] = array('default' => $default, 'cast' => $castFunction);
    }

    public function contains($key){
        return key_exists($key, $this->items);
    }

    public function default($key){
        return $this->items[$key]['default'];
    }

    public function cast($key, $value){
        return $this->items[$key]['cast']($value);
    }
}