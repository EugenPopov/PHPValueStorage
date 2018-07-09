<?php

namespace App\Tests;
use App\JsonKeyValueStorage;

class YAMLKeyValueStorageTest extends TestCase
{

    private $file;

    public function setUp()
    {
        $this->file = new YAMLKeyValueStorage(__DIR__ . '/../data/YamlStorage.yaml');
    }

    public function testSet()
    {
        $this->file->set('name', 'Eugene');

        $this->assertEquals('777', $this->file->get('name'));
    }

    public function testGet()
    {
        $this->file->set('eugene', 'popov');

        $this->assertEquals('popov' , $this->file->get('euegene'));
        $this->assertNull($this->file->get('sdgfasd'));
    }

    public function testHas()
    {
        $this->file->set('asd', '228');

        $this->assertTrue($this->file->has('asd'));
    }

    public function testRemove()
    {
        $this->file->set('fgh', 'dfsghdf');
        $this->file->remove('fgh');

        $this->assertFalse($this->file->has('fgh'));
    }

    public function testClear()
    {
        $this->file->set('qwe', '123');
        $this->file->set('rty', '456');

        $this->file->clear();

        $this->assertFalse($this->file->has('qwe'));
        $this->assertFalse($this->file->has('rty'));

    }
}


