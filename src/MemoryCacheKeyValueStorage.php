<?php

namespace App;


class MemoryCacheKeyValueStorage implements KeyValueStorageInterface
{

    private $storage = [];

    public function set(string $key, $value): void
    {
        if(!$this->has($key)){
            $this->storage[$key]=$value;
        }
    }

    public function get(string $key)
    {
        return $this->storage[$key];
    }

    public function has(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function remove(string $key): void
    {
        if($this->has($key)){
            unset($this->storage[$key]);
        }
    }

    /**
     * Clear storage.
     */
    public function clear(): void
    {
       $this->storage=[];
    }
}