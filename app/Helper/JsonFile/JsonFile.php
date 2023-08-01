<?php

namespace App\Helper\JsonFile;
use Exception;
use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

class JsonFile extends AbstractJsonFile
{
    /**
     * @throws Exception
     */
    public function read(): array
    {
        $handle = fopen($this->filePath, 'r');

        if (!$handle) {
            throw new Exception('Failed to open file ' . $this->filePath);
        }

        $filteredObjects = [];

        $this->processReadFile($filteredObjects);

        return $filteredObjects;
    }

    private function processReadFile(&$filteredObjects): void
    {
        $data = Items::fromFile($this->filePath, ['decoder' => new ExtJsonDecoder(true)]);

        foreach ($data as $value ){
            if ($this->filter($value)) {
                $filteredObjects[] = $value;
            }
        }
    }

   protected function filter(array $decodedLine): bool
   {
       // Apply all filters to the object
       foreach ($this->filters as $filter) {
           if (!$filter->apply($decodedLine)) {
               return false;
           }
       }
       return true;
   }

}
