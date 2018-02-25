<?php

use PHPUnit\Framework\TestCase;
use Context\EnvContext;

class DriverTest extends TestCase
{
    private $driver;
    public function setUp(){
        $this->driver = new EnvContext();
    }

    public function testGetStringKey(){
        $value = 42;
        $key   = 'env_string_option';
        $_ENV[$key] = $value;
        $this->assertEquals((string)$value, $this->driver->get($key));
    }

    public function testGetNonSetKey() {
        $value = "string-value";
        $key   = 'env_var_string_2';
        $default = "default";
        $this->assertEquals($default, $this->driver->get($key, $default));
    }
}
