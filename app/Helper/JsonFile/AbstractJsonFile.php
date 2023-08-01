<?php

namespace App\Helper\JsonFile;

abstract class AbstractJsonFile
{
    public function __construct(protected string $filePath,protected  array $filters)
    {
    }

    abstract public function read(): array;
    abstract protected function filter(array $decodedLine): bool;
}
