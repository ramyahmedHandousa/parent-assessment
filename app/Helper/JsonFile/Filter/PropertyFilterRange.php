<?php

namespace App\Helper\JsonFile\Filter;

use App\Helper\JsonFile\Filter\interface\JsonFilter;

class PropertyFilterRange implements JsonFilter
{

    public function __construct(private  string $property, private string|null $valueMin, private string|null $valueMax)
    {
    }

    public function apply(array $object): bool
    {
        if (!isset($object[$this->property])) {
            return false;
        }
        if ($this->valueMin && $object[$this->property] < $this->valueMin) {
            return false;
        }
        if ($this->valueMax && $object[$this->property] > $this->valueMax) {
            return false;
        }
        return true;
    }
}
