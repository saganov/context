<?php

namespace Context;

class EnvContext implements ContextDriverInterface
{
    public function get($key, $default = null){
        return ((key_exists($key, $_ENV)) ? $_ENV[$key] : $default);
    }
}
