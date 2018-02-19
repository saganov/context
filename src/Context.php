<?php

namespace Context;

class Context implements IContext
{
    private $scheme;
    private $driver;
    public function __construct(IScheme $scheme, IContextDriver $driver){
        $this->scheme = $scheme;
        $this->driver = $driver;
    }

    public function get($key){
        if ($this->scheme->contains($key)){
            $value = $this->driver->resolve($key, $this->scheme->defaultVal($key));
            // TODO: there is knowing of Context about Scheme that
            // default value NULL means required key
            if (is_null($value)) throw new RequiredKeyException("Required context key: '{$key}' left unset");
            $value = $this->scheme->cast($key, $value);
            return $value;
        } else {
            throw new UnknownKeyException("Unknown context key: '{$key}' has requested");
        }
    }
}

class RequiredKeyException extends \Exception{}
class UnknownKeyException extends \Exception{}
