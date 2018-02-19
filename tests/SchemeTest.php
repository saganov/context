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
        $this->assertEquals('Default Value', $this->scheme->default('Context_var_1'));
    }
    public function testSchemeCastToString(){
        $this->assertEquals('Context value', $this->scheme->cast('Context_var_1', 'Context value'));
    }

}
