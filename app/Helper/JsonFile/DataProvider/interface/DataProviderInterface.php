<?php

namespace App\Helper\JsonFile\DataProvider\interface;

interface DataProviderInterface
{
    public function data();
    public function columns($object);
    public function filters();

}
