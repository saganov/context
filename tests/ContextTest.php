<?php

use PHPUnit\Framework\TestCase;
use Context\IScheme;
use Context\IContextDriver;
use Context\Context;

class ContextTest extends TestCase
{
    private $context;
    private $scheme;
    private $driver;
    public function setUp(){
        $this->scheme = $this->createMock(IScheme::class);
        $this->driver = $this->createMock(IContextDriver::class);
        $this->context = new Context($this->scheme, $this->driver);
    }

    public function testContextRetrievingSetOptionalValue(){
        $value = 42;
        $this->scheme->method('contains')->willReturn(true);
        $this->scheme->method('default')->willReturn(0);
        $this->scheme->method('cast')->willReturn((string)$value);
        $this->driver->method('resolve')->willReturn(42);

        $this->assertEquals('42', $this->context->get('Context_var_1'));
    }
}
