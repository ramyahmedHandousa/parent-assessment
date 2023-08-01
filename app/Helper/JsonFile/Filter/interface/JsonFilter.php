<?php

namespace App\Helper\JsonFile\Filter\interface;

interface JsonFilter
{
    public function apply(array $object): bool;
}
