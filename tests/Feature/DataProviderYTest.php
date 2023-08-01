<?php
namespace Tests\Feature;

use App\Helper\JsonFile\DataProvider\Classes\DataProviderY;
use App\Helper\JsonFile\Filter\PropertyFilter;
use Tests\TestCase;
class DataProviderYTest extends TestCase {

    public function testData() {
        $dataProvider = new DataProviderY();

        $this->app['request']->merge(['provider' => 'OtherProvider']);
        $this->assertEquals([], $dataProvider->data());

        $this->app['request']->merge(['provider' => 'DataProviderY']);
        $data = $dataProvider->data();
        $this->assertArrayHasKey('balance', $data[0]);

        $this->app['request']->merge(['currency' => 'USD']);
        $data = $dataProvider->data();

        $this->assertNotEmpty($data);
        $this->app['request']->merge(['balanceMin' => 50, 'balanceMax' => 100]);
        $data = $dataProvider->data();
        foreach ($data as $row) {
            $this->assertGreaterThanOrEqual(50, $row['balance']);
            $this->assertLessThanOrEqual(100, $row['balance']);
        }

    }
    public function testHaveColumnsData()
    {
        // Call the data() method and assert that it returns an array
        $dataProvider = new DataProviderY();
        $result = $dataProvider->data();
        $this->assertIsArray($result);

        // Assert that each item in the array is an array with the expected keys
        foreach ($result as $item) {
            $this->assertIsArray($item);
            $this->assertArrayHasKey('balance', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('email', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('created_at', $item);
            $this->assertArrayHasKey('id', $item);
        }
    }

    public function testColumns() {
        $dataProvider = new DataProviderY();
        $input = [
            'balance' => 120,
            'currency' => 'USD',
            'email' => 'test@example.com',
            'status' => 100,
            'created_at' => '2020-01-01 00:00:00',
            'id' => 1
        ];

        $expected = [
            'balance' => 120,
            'currency' => 'USD',
            'email' => 'test@example.com',
            'status' => 'authorised',
            'created_at' => '2020-01-01 00:00:00',
            'id' => 1
        ];
        $this->assertEquals($expected, $dataProvider->columns($input));
    }

    public function testStatusCodeMapping() {
        $dataProvider = new DataProviderY();
        $this->assertEquals('authorised', $dataProvider->columStatusCode(100));
        $this->assertEquals('decline', $dataProvider->columStatusCode(200));
        $this->assertEquals('refunded', $dataProvider->columStatusCode(300));
    }

    public function testFilters() {
        $dataProvider = new DataProviderY();
        $filters = $dataProvider->filters();
        $this->assertCount(1, $filters);
        $this->assertInstanceOf(PropertyFilter::class, $filters[0]);
    }
}
