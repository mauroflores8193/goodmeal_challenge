<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StoreTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testListWithStock() {
        $storesWithStock = 10;
        Store::factory($storesWithStock)->for($this->user)->has($this->producstWithStock(2))->create();
        $storesWithoutStock = 2;
        Store::factory($storesWithoutStock)->for($this->user)->has($this->producstWithoutStock(2))->create();
        $response = $this->get('/api/stores');
        $response->assertOk()->assertJsonCount($storesWithStock);
    }

    private function producstWithStock($count = 1) {
        return Product::factory()->for($this->user)->state(['amount' => 1])->count($count);
    }

    private function producstWithoutStock($count = 1) {
        return Product::factory()->for($this->user)->state(['amount' => 0])->count($count);
    }

    public function testShow() {
        $productsCount = 5;
        $store = Store::factory()->for($this->user)->has($this->producstWithStock($productsCount))->create();
        $response = $this->get('/api/stores/' . $store->id);
        $response->assertOk()
            ->assertJson(function (AssertableJson $json) use ($store, $productsCount) {
                $json->hasAll( 'startTime', 'endTime', 'location', 'latitude', 'longitude', 'products')
                    ->where('id', $store->id)
                    ->where('name', $store->name)
                    ->where('banner', $store->banner)
                    ->where('icon', $store->icon)
                    ->etc();
            });
    }
}
