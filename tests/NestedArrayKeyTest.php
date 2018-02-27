<?php

use PHPUnit\Framework\TestCase;

class NestedArraysKeyTest extends TestCase
{
    private $ini = ['one' => ['two' => ['three' => 3]]];
    public function testArrayTopLevel(){
        $key = 'one';
        $this->assertArraySubset(['two' => ['three' => 3]], $this->getNestedKey($key, $this->ini, null));
    }
    public function testArraySecondLevel(){
        $key = "one.two";
        $this->assertArraySubset(['three' => 3], $this->getNestedKey($key, $this->ini, null));
    }
    public function testArrayThirdLevel(){
        $key = "one.two.three";
        $this->assertEquals(3, $this->getNestedKey($key, $this->ini, null));
    }
    public function testUnknownKey(){
        $key = "one.two.three.four";
        $this->assertEquals('default', $this->getNestedKey($key, $this->ini, 'default'));
    }

    private function getNestedKey($key, array $data, $default){
        foreach(explode('.', $key) as $k){
            if(!is_array($data) || !key_exists($k, $data)){
                $data = $default;
                break;
            }
            $data = $data[$k];
        }
        return $data;
    }
}
