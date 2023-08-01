<?php

namespace App\Repository;

use App\Helper\JsonFile\DataProvider\Classes\DataProviderX;
use App\Helper\JsonFile\DataProvider\Classes\DataProviderY;
use App\Repository\interface\JsonFileRepositoryInterface;
class JsonFileRepository implements JsonFileRepositoryInterface
{


    public function readFile()
    {
        $files = [
            new DataProviderX(),
            new DataProviderY(),
        ];
        $data = [];
        foreach ($files as $dataSource) {
            array_push($data, ...$dataSource->data());
        }

        return $data;
    }
}
