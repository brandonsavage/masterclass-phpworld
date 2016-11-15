<?php

class RequestTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->request = new \Masterclass\Request\Request(
            ['abc' => 'def'],
            ['ghi' => 123],
            ['hello' => 'world'],
            ['hello' => 'phpworld']);
    }

    public function testGetArrayConversion()
    {
        $request = $this->request;

        $outcome = $request->get('abc');

        $this->assertEquals('def', $outcome);
    }

    public function testSessionArrayConversion()
    {
        $request = $this->request;

        $outcome = $request->session('hello');
        $this->assertEquals('world', $outcome);
    }
}