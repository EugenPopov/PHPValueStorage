<?php

namespace App\Storage;

class JsonKeyValueStorage implements KeyValueStorageInterface
{
    private $file;
    public function __construct($file)
    {
        $this->file = $file;
    }
    public function set( string $key, $value) :void
    {
        $array = $this->getContentFromJson();
        $array[$key] = $value;
        $this->setContentToJson($array);
    }
    public function get(string $key)
    {
        $array = $this->getContentFromJson();
        if ($this->has($key)){
            return $array[$key];
        }
    }
    public function has(string $key): bool
    {
        $array = $this->getContentFromJson();
        return isset($array[$key]);
    }
    public function remove(string $key): void
    {
        $array = $this->getContentFromJson();
        unset($array[$key]);
        $this->setContentToJson($array);
    }
    public function clear(): void
    {
        $this->setContentToJson('');
    }
    private function getContentFromJson():?array
    {
        if(!(file_exists($this->file))){
            fopen($this->file, "w");
        }
        $string = file_get_contents($this->file);
        return json_decode($string,true);
    }
    private function setContentToJson($array):void
    {
        $json = json_encode($array);
        file_put_contents($this->file, $json,  LOCK_EX);
    }
    public function getfile():string
    {
        return $this->file;
    }
}