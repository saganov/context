<?php

namespace Context;

class EnvVariablesDriver implements IContextDriver
{
    public function __construct(){
    
    }

    public function resolve($key, $default = null){
        return ((key_exists($key, $_ENV)) ? $_ENV[$key] : $default);
    }
}
