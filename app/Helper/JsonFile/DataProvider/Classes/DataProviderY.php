<?php

namespace App\Helper\JsonFile\DataProvider\Classes;

use App\Helper\JsonFile\DataProvider\interface\DataProviderInterface;
use App\Helper\JsonFile\DataProvider\trait\filterDataFile;
use App\Helper\JsonFile\Filter\PropertyFilter;
use App\Helper\JsonFile\Filter\PropertyFilterRange;
use App\Helper\JsonFile\JsonFileFactory;
class DataProviderY implements DataProviderInterface
{
    use filterDataFile;
    private string $filePath ;
    private string $name = 'DataProviderY' ;
    public function __construct()
    {
        $this->filePath =  storage_path('JsonFile/DataProviderY.json');
    }

    public function data()
    {
        if (request('provider') && request('provider') != $this->name){
            return  [];
        }

        $factory    = new JsonFileFactory();
        $dataFiles  = $factory->create($this->filePath, $this->globalFilter())->read();
        return $this->filterDataFile($dataFiles);
    }

    public function columns($object): array
    {
        return [
            'balance'        => $object['balance'] ?? null,
            'currency'       => $object['currency'] ?? null,
            'email'          => $object['email'] ?? null,
            'status'         => $this->columStatusCode($object['status'] ?? null),
            'created_at'     => $object['created_at'] ?? null,
            'id'             => $object['id'] ?? null,
        ];
    }
    public function columStatusCode($statusCode): string
    {
        return match ($statusCode) {
            100       => 'authorised',
            200       => 'decline',
            default   => 'refunded',
        };
    }

    public function filters(): array
    {
        return [
            new PropertyFilter('status', request()->statusCode),
        ];
    }

    /**
     * @return array
     * GlobalFilter  make Filter First Loop Optimize Fetch Data
     */
    private function globalFilter(): array
    {
        return [
            new PropertyFilter('currency', request()->currency),
            new PropertyFilterRange('balance',request()->balanceMin,request()->balanceMax)
        ];
    }
}
