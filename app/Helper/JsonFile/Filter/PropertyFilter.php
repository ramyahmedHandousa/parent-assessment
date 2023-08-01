<?php

namespace App\Helper\JsonFile\Filter;

use App\Helper\JsonFile\Filter\interface\JsonFilter;

class PropertyFilter implements JsonFilter
{

    public function __construct(private  string $property, private string|null $value)
    {
    }

    public function apply(array $object): bool
    {
        if ($this->value){
            return isset($object[$this->property]) && $object[$this->property] == $this->value;
        }
        return true;
    }
}
