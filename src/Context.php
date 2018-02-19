<?php

namespace Context;

class Context
{
    private $scheme;
    private $driver;
    public function __construct(IScheme $scheme, IContextDriver $driver){
        $this->scheme = $scheme;
        $this->driver = $driver;
    }

    public function get($key){
        if ($this->scheme->contains($key)){
            $value = $this->driver->resolve($key, $this->scheme->default($key));
            $value = $this->scheme->cast($key, $value);
            return $value;
        } else {
            throw new Exception("Unknown context key: '{$key}' has requested");
        }
    }
}
