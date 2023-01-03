<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;

class ProductTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        Storage::fake('public');
        $this->userAuth = User::all()->first();
        $this->store = Store::factory()->for($this->userAuth)->create();
        $this->request = $this->actingAs($this->userAuth);
    }

    public function testList() {
        Product::factory(10)->for($this->userAuth)->for($this->store)->create();
        $response = $this->request->get("/api/admin/stores/".$this->store->id."/products");
        $response->assertOk()->assertJsonCount(10);
    }

    public function testCreate() {
        $data = [
            'name' => 'name',
            'price' => 15.50,
            'discount' => 5,
            'amount' => 10,
            'image' => $this->createFakeImg('image.png'),
        ];
        $response = $this->request
            ->withHeaders(['Content-Type' => 'multipart/form-data; boundary=<calculated when request is sent>'])
            ->post("/api/admin/stores/".$this->store->id."/products", $data);
        $lastProduct = Product::all()->last();
        $response->assertCreated()
            ->assertJson(function (AssertableJson $json) use ($lastProduct) {
                $json->where('id', $lastProduct->id)
                    ->where('name', $lastProduct->name)
                    ->where('price', $lastProduct->price)
                    ->where('discount', $lastProduct->discount)
                    ->where('amount', $lastProduct->amount)
                    ->etc();
            });
        Storage::disk('public')->assertExists("uploads/{$lastProduct->image}");
    }

    public function testShow() {
        $product = $this->createProduct($this->userAuth, $this->store);
        $response = $this->request->get("/api/admin/products/" . $product->id);
        $response->assertOk()->assertJson($product->toArray());
    }

    public function testUpdate() {
        $product = $this->createProduct($this->userAuth, $this->store);
        $data = [
            'name' => 'new name',
            'price' => 35.50,
            'discount' => 50,
            'amount' => 100,
            'image' => $this->createFakeImg('image.png'),
        ];
        $response = $this->request->put("/api/admin/products/" . $product->id, $data);
        $response->assertNoContent();
        $lastProduct = Product::find($product->id);
        $this->assertEquals($lastProduct->name, $data['name']);
        $this->assertEquals($lastProduct->price, $data['price']);
        $this->assertEquals($lastProduct->discount, $data['discount']);
        $this->assertEquals($lastProduct->amount, $data['amount']);
        Storage::disk('public')->assertExists("uploads/{$lastProduct->icon}");
        Storage::disk('public')->assertExists("uploads/{$lastProduct->banner}");
    }

    public function testDestroy() {
        $product = $this->createProduct($this->userAuth, $this->store);
        $response = $this->request->delete("/api/admin/products/" . $product->id);
        $response->assertNoContent();
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    private function createProduct($user, $store) {
        return Product::factory()->for($user)->for($store)->create();
    }
}
