<?php

declare(strict_types=1);

namespace App\Entities;

abstract class Entity
{

    protected array $data = [];

    public function __construct($obj = new \stdClass())
    {
        $data = (array)$obj;
        foreach ($data as $key => $val) {
            if (isset($this->data[$key])) {
                $this->{$key} = $val;
            }
        }
    }

    public function __get($key)
    {
        $value = null;

        if (isset($this->data[$key])) {
            $value = $this->data[$key];
        }

        return $value;
    }

    public function __set($key, $value)
    {
        if (isset($this->data[$key])) {
            $this->data[$key] = $value;
        }
    }

    public function toArray($exclude = [])
    {
        $data = $this->data;
        foreach ($data as $key => $val) {
            if (in_array($key, $exclude)) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
