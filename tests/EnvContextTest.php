<?php

use PHPUnit\Framework\TestCase;
use Context\IScheme;
use Context\EnvContext;
use Context\RequiredKeyException;

class ContextTest extends TestCase
{
    private $context;
    private $scheme;
    public function setUp(){
        $this->scheme = $this->createMock(IScheme::class);
        $this->context = new EnvContext($this->scheme);
        $this->scheme->method('contains')->willReturn(true);
    }

    public function testContextRetrievingSetOptionalValue(){
        $value = 42;
        $key   = 'env_var_1';
        $_ENV[$key] = $value;
        $this->scheme->method('defaultVal')->willReturn(null);
        $this->scheme->method('cast')->willReturn((string)$value);
        $this->assertEquals((string)$value, $this->context->get($key));
    }

    public function testReadStringVariableWithoutDefault() {
        $value = "string-value";
        $key   = 'env_var_string_1';
        $_ENV[$key] = $value;
        $this->scheme->method('defaultVal')->willReturn(null);
        $this->scheme->method('cast')->willReturn((string)$value);
        $this->assertEquals((string)$value, $this->context->get($key));
    }
    public function testReadStringVariableWithDefault() {
        $value = "string-value";
        $key   = 'env_var_string_2';
        $default = "default";
        $_ENV[$key] = $value;
        $this->scheme->method('cast')->willReturn((string)$value);
        $this->scheme->method('defaultVal')->willReturn($default);
        $this->assertEquals((string)$value, $this->context->get($key));
    }
    public function testReadUnsetVariableWithDefault() {
        $default = "default";
        $this->scheme->method('cast')->willReturn((string)$default);
        $this->scheme->method('defaultVal')->willReturn($default);
        $this->assertEquals((string)$default, $this->context->get('env_var_unset'));
    }
    public function testReadUnsetVariableWithoutDefault() {
        $this->scheme->method('defaultVal')->willReturn(null);
        $this->scheme->method('cast')->willReturn((string)42);
        $this->expectException(RequiredKeyException::class);
        $this->context->get('env_var_unset');
    }
}
