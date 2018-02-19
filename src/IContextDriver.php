<?php

namespace Context;

interface IContextDriver
{
    public function resolve($key, $default);
}
