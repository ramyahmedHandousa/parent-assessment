<?php

namespace App\Helper\JsonFile\DataProvider\trait;

trait filterDataFile
{

    private function filterDataFile($dataFiles): array
    {
//        $data = [];
//        foreach ($dataFiles as $row){
//
//            $newRow = null;
//            if ($this->columns($row) !== null){
//                $newRow = $this->columns($row);
//            }
//            if ($newRow && $this->filterObject($newRow)){
//                $data[] = $row;
//            }
//        }
//        return $data;

        return array_filter($dataFiles, function ($row) {
            $newRow = $this->columns($row);
            return $newRow && $this->filterObject($newRow);
        });
    }


    private function filterObject(array $row): bool
    {
        foreach ($this->filters() as $filter) {

            if (!$filter->apply($row)) {
                return false;
            }
        }
        return true;
    }
}
