<?php

namespace Tests\Feature;

use App\Helper\JsonFile\Filter\PropertyFilter;
use Tests\TestCase;
use App\Helper\JsonFile\DataProvider\Classes\DataProviderX;

class DataProviderXTest extends TestCase
{
    public function testData()
    {
        $dataProvider = new DataProviderX();

        $this->call('GET', 'api/v1/users', ['provider' => 'OtherProvider']);
        $this->assertEquals([], $dataProvider->data());

        $this->call('GET', 'api/v1/users');
        $this->assertIsArray($dataProvider->data());

        $this->app['request']->merge(['currency' => 'USD']);
        $data = $dataProvider->data();

        $this->assertNotEmpty($data);
    }

    public function testHaveColumnsData()
    {
        // Call the data() method and assert that it returns an array
        $dataProvider = new DataProviderX();
        $result = $dataProvider->data();
        $this->assertIsArray($result);

        // Assert that each item in the array is an array with the expected keys
        foreach ($result as $item) {
            $this->assertIsArray($item);
            $this->assertArrayHasKey('parentAmount', $item);
            $this->assertArrayHasKey('Currency', $item);
            $this->assertArrayHasKey('parentEmail', $item);
            $this->assertArrayHasKey('statusCode', $item);
            $this->assertArrayHasKey('registerationDate', $item);
            $this->assertArrayHasKey('parentIdentification', $item);
        }
    }

    public function testColumns()
    {
        $dataProvider = new DataProviderX();
        $data =  [
            "parentAmount"          =>  200,
            "parentEmail"           =>  "parent1@parent.eu",
            "Currency"              =>  "YEN",
            "statusCode"            =>  2,
            "registerationDate"     =>  "2023-11-30",
            "parentIdentification"  => "1d3d29d70-1d25-11e3-8591-034165a3a613"
        ];

        $expected =  [
            "parentAmount"          =>  200,
            "parentEmail"           =>  "parent1@parent.eu",
            "Currency"              =>  "YEN",
            "statusCode"            =>  'decline',
            "registerationDate"     =>  "2023-11-30",
            "parentIdentification"  => "1d3d29d70-1d25-11e3-8591-034165a3a613"
        ];
        $this->assertEquals($expected, $dataProvider->columns($data));
    }

    public function testStatusCodeColumn()
    {
        $dataProvider = new DataProviderX;
        $this->assertEquals('authorised', $dataProvider->columStatusCode(1));
        $this->assertEquals('decline', $dataProvider->columStatusCode(2));
        $this->assertEquals('refunded', $dataProvider->columStatusCode(3));
    }

    public function testFilters()
    {
        $dataProvider = new DataProviderX;
        $filters = $dataProvider->filters();
        $this->assertCount(1, $filters);
        $this->assertContainsOnlyInstancesOf(PropertyFilter::class, $filters);
    }
}
