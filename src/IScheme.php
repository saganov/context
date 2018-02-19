<?php

namespace Context;

interface IScheme
{
    public function add($key, $default, $castFunction = null);
    public function contains($key);
    public function cast($key, $value);
    public function default($key);
}
