<?php

use PHPUnit\Framework\TestCase;
use Context\Context;
use Context\ContextDriverInterface;
use Context\RequiredKeyException;

class ContextTest extends TestCase
{
    private $context;
    private $driver;
    public function setUp(){
        $this->driver = $this->createMock(ContextDriverInterface::class);
        $this->context = new Context($this->driver);
    }

    /**
    * @dataProvider stringKeysProvider
    */
    public function testGetString($input, $expected){
        $key = 'context_string_key';
        $this->context->add($key);
        // the same as the following
        // $this->context->add($key, null, function($v){return (string)$v;})
        $this->driver->method('get')->willReturn($input);
        $this->assertEquals($expected, $this->context->get($key));
    }
    /**
    * @dataProvider integerKeysProvider
    */
    public function testGetInteger($input, $expected){
        $key = 'context_integer_key';
        $this->context->add($key, null, function($v){return (int)$v;});
        $this->driver->method('get')->willReturn($input);
        $this->assertEquals($expected, $this->context->get($key));
    }
    /**
    * @dataProvider booleanKeysProvider
    */
    public function testGetBoolean($input, $expected){
        $key = 'context_boolean_key';
        $this->context->add($key, null, function($v){return (bool)$v;});
        $this->driver->method('get')->willReturn($input);
        $this->assertEquals($expected, $this->context->get($key));
    }
    /**
    * @dataProvider validEnumKeysProvider
    */
    public function testGetEnumValid($input, $expected){
        $key = 'context_enum_key';
        $available = ['one', 'two', 'three'];
        $cast_function = function($v) use ($available){
            if (in_array($v, $available)) {
                return $v;
            } else {
                throw new InvalidValueException();
            }
        };
        $this->context->add($key, null, $cast_function);
        $this->driver->method('get')->willReturn($input);
        $this->assertEquals($expected, $this->context->get($key));
    }
    public function testRequiredKey() {
        $key = 'context_required_key';
        $this->context->add($key, Context::REQUIRED_KEY);
        $this->driver->method('get')->willReturn(Context::REQUIRED_KEY);
        $this->expectException(RequiredKeyException::class);
        $this->context->get($key);
    }
    
    public function stringKeysProvider()
    {
        return [
            [0, '0'],
            ['00', '00'],
            ['01', '01'],
            [1, '1'],
            [11, '11'],
            ['string', 'string'],
            ['1string', '1string'],
            // TODO: should the Object care about cases below?
            //[1+1, '1+1'],
            //[false, 'false'],
            //[true, 'true'],
            //[null, 'null'],
        ];
    }
    public function integerKeysProvider()
    {
        return [
            [0, 0],
            [1, 1],
            [11, 11],
            // TODO: are the cases below have valid expectations?
            ['string', 0],
            ['1string', 1],
            [1+1, 2],
            [false, 0],
            [true, 1],
            [null, 0],
        ];
    }
    public function booleanKeysProvider()
    {
        return [
            //['false', false],
            ['true', true],
            [0, false],
            //['00', false],
            ['01', true],
            [1, true],
            [11, true],
            // TODO: should the Object care about cases below?
            ['string', true],
            ['1string', true],
            [1+1, true],
            [false, false],
            [true, true],
            [null, false],
            //['on', true],
            //['off', false],
        ];
    }
    public function validEnumKeysProvider()
    {
        return [
            ['one', 'one'],
            ['two', 'two'],
            ['three', 'three'],
        ];
    }
}
