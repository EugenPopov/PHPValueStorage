<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\JsonKeyValueStorage;

class JsonKeyValueStorageTest extends TestCase
{

    private $file;

    public function setUp()
    {
        $this->file=new JsonKeyValueStorage(__DIR__.'/../data/JsonStorage.json');
    }

    public function testSet()
    {
        $this->file->set('name','Eugene');

        $this->assertEquals('Eugene',$this->file->get('name'));
    }

    public function testGet()
    {
        $this->assertNull($this->file->get('sgfd'));
    }

    public function testHas()
    {
        $this->file->set('gdgsd','345234g');

        $this->assertTrue($this->file->has('gdgsd'));
    }

    public function testRemove()
    {
        $this->file->set('eugene','popov');
        $this->file->remove('eugene');

        $this->assertFalse($this->file->has('eugene'));
    }

    public function testClear()
    {
        $this->file->set('name','gdfgdsfgdf');
        $this->file->set('3gt3','49gd9dgdfs');

        $this->file->clear();

        $this->assertFalse($this->file->has('name'));

    }
}