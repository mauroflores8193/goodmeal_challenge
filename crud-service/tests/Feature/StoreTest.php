<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase {

    public function testListWithStock() {
        $user = User::factory()->create();
        $storesWithStock = 10;
        Store::factory($storesWithStock)->for($user)->has($this->producstWithStock($user))->create();
        $storesWithoutStock = 2;
        Store::factory($storesWithoutStock)->for($user)->has($this->producstWithoutStock($user))->create();
        $response = $this->get('/api/stores');
        $response->assertOk()->assertJsonCount($storesWithStock);
    }

    private function producstWithStock($user) {
        return Product::factory()->for($user)->state(['amount' => 1])->count(2);
    }

    private function producstWithoutStock($user) {
        return Product::factory()->for($user)->state(['amount' => 0])->count(2);
    }
}
