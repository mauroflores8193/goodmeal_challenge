<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase {

    public function testList() {
        $userNew = User::factory()->create();
        Store::factory(10)
            ->for($userNew)
            ->has(
                Product::factory()
                    ->for($userNew)
                    ->state(['amount' => 1])
                    ->count(2)
            )
            ->create();
        $response = $this->get('/api/stores');
        $response->assertOk()->assertJsonCount(10);
    }
}
