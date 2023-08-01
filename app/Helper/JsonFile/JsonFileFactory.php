<?php

namespace App\Helper\JsonFile;

class JsonFileFactory
{
    public function create(string $filePath, array $filters): AbstractJsonFile
    {
        return new JsonFile($filePath, $filters);
    }
}
