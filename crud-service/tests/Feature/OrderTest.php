<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class OrderTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        $buyer = User::factory()->create();
        $this->store = Store::factory()->for($buyer)->create();
        $this->products = Product::factory(3)->for($buyer)->for($this->store)->create();
    }

    public function testList() {
        $client = User::factory()->create();
        $ordersCount = 10;
        for ($i = 0; $i < $ordersCount; $i++) {
            $order = Order::factory()->for($this->store)->for($client)->create();
            for ($j = 0; $j < rand(0, 2); $j++) {
                OrderDetail::factory()->for($this->products[$j])->for($order)->create();
            }
        }
        $response = $this->get('/api/orders');
        $response->assertOk()->assertJsonCount($ordersCount);
    }

    public function testShow() {
        $client = User::factory()->create();
        $order = Order::factory()->for($this->store)->for($client)->create();
        for ($j = 0; $j < 3; $j++) {
            OrderDetail::factory()->for($this->products[$j])->for($order)->create();
        }
        $response = $this->get('/api/orders/' . $order->id);
        $response->assertOk()
            ->assertJson(function (AssertableJson $json) use ($order) {
                $json->hasAll('details', 'deliveryStarTime', 'deliveryEndTime')
                    ->where('id', $order->id)
                    ->where('storeName', $order->storeName)
                    ->where('storeAddress', $order->storeAddress)
                    ->where('shippingCost', $order->shipping_cost)
                    ->where('total', (int) $order->total)
                    ->where('deliveryDate', $order->delivery_date)
                    ->etc();
            });
    }
}
