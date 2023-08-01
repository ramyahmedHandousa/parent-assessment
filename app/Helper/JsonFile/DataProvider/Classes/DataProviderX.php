<?php

namespace App\Helper\JsonFile\DataProvider\Classes;

use App\Helper\JsonFile\DataProvider\interface\DataProviderInterface;
use App\Helper\JsonFile\DataProvider\trait\filterDataFile;
use App\Helper\JsonFile\Filter\PropertyFilter;
use App\Helper\JsonFile\Filter\PropertyFilterRange;
use App\Helper\JsonFile\JsonFileFactory;
class DataProviderX implements DataProviderInterface
{
    use filterDataFile;
    private string $filePath ;
    private string $name = 'DataProviderX' ;
    public function __construct()
    {
        $this->filePath =  storage_path('JsonFile/DataProviderX.json');
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
            'parentAmount'          => $object['parentAmount'] ?? null,
            'Currency'              => $object['Currency'] ?? null,
            'parentEmail'           => $object['parentEmail'] ?? null,
            'statusCode'            => $this->columStatusCode($object['statusCode'] ?? null),
            'registerationDate'     => $object['registerationDate'] ?? null,
            'parentIdentification'  => $object['parentIdentification'] ?? null,
        ];
    }
    public function columStatusCode($statusCode)
    {
        return match ($statusCode) {
            1       => 'authorised',
            2       => 'decline',
            default => 'refunded',
        };
    }

    public function filters(): array
    {
        return [
            new PropertyFilter('statusCode', request()->statusCode),
        ];
    }

    /**
     * @return array
     * GlobalFilter  make Filter First Loop Optimize Fetch Data
     */
    public function globalFilter(): array
    {
        return [
            new PropertyFilter('Currency', request()->currency),
            new PropertyFilterRange('parentAmount',request()->balanceMin,request()->balanceMax)
        ];
    }
}
