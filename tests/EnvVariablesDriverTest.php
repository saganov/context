<?php

use PHPUnit\Framework\TestCase;
use Context\EnvVariablesDriver;

class EnvVariablesDriverTest extends TestCase
{
    private $driver;
    public function setUp(){
        $this->driver = new EnvVariablesDriver();
        $_ENV["Context_var_1"] = "context_var_1";
        $_ENV["Context_var_2"] = "context_var_2";
    }

    public function testReadStringVariableWithoutDefault() {
        $this->assertEquals('context_var_1', $this->driver->resolve('Context_var_1'));
    }
    public function testReadStringVariableWithDefault() {
        $this->assertEquals('context_var_1', $this->driver->resolve('Context_var_1', 'Default value'));
    }
    public function testReadUnsetVariableWithoutDefault() {
        $this->assertNull($this->driver->resolve('Context_var_unset'));
    }
    public function testReadUnsetVariableWithDefault() {
        $this->assertEquals('Default value', $this->driver->resolve('Context_var_unset', 'Default value'));
    }
}
