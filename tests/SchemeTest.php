<?php

use PHPUnit\Framework\TestCase;
use Context\Scheme;

class SchemeTest extends TestCase
{
    private $scheme;
    public function setUp(){
        $this->scheme = new Scheme();
        $this->scheme->add('Context_var_1', 'Default Value');
    }

    public function testSchemeContainsExistentKey(){
        $this->assertTrue($this->scheme->contains('Context_var_1'));
    }
    public function testSchemeContainsUnexistentKey(){
        $this->assertFalse($this->scheme->contains('Context_var_unexistent'));
    }
    public function testSchemeDefaultValue(){
        $this->assertEquals('Default Value', $this->scheme->defaultVal('Context_var_1'));
    }
    public function testSchemeDefaultValueWithoutSetDefault(){
        $this->scheme->add('Context_var_without_default');
        $this->assertNull($this->scheme->defaultVal('Context_var_without_default'));
    }
    public function testSchemeCastToString(){
        $this->assertEquals('Context value', $this->scheme->cast('Context_var_1', 'Context value'));
    }
    public function testSchemeCastToInteger(){
        $this->scheme->add('Context_integer', null, function($v){return (int)$v;});
        $this->assertEquals(42, $this->scheme->cast('Context_integer', '42'));
    }
    public function testSchemeCastToBoolean(){
        $this->scheme->add('Context_boolean', null, function($v){return (bool)$v;});
        $this->assertTrue($this->scheme->cast('Context_boolean', '1'));
    }

}
