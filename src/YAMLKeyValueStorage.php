<?php
namespace App;

use Symfony\Component\Yaml\Yaml;



class YAMLKeyValueStorage implements KeyValueStorageInterface
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename=$filename;

    }

    public function set(string $key, $value):void
    {
        $array = $this->getContentFromYAML();
        $array[$key] = $value;
        $yaml = Yaml::dump($array);
        file_put_contents($this->filename, $yaml, LOCK_EX);
    }

    public function get(string $key)
    {
        if ($this->has($key)) {
            $array = Yaml::parseFile($this->filename);
            return $array[$key];
        }

    }

    public function has(string $key):bool
    {
        $array = Yaml::parseFile($this->filename);
        return isset($array[$key]);
    }



    public function remove(string $key):void
    {
        $array = Yaml::parseFile($this->filename);
        if ($this->has($key))
            unset($array[$key]);
        file_put_contents($this->filename, $array,  LOCK_EX);

    }


    public function clear():void
    {
        file_put_contents($this->filename, '',  LOCK_EX);
    }

    private function getContentFromYAML():?array
    {

        if(!(file_exists($this->filename))){
            fopen($this->filename, "w");
        }
        return Yaml::parseFile($this->filename);
    }

    public function getFileName():string
    {
        return $this->filename;
    }
}