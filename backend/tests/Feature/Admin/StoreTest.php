<?php

namespace Tests\Feature\Admin;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StoreTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        Storage::fake('public');
        $this->userAuth = User::factory()->create();
        $this->request = $this->actingAs($this->userAuth);
    }

    public function testList() {
        Store::factory(10)->for($this->userAuth)->create();
        $response = $this->request->get('/api/admin/stores');
        $response->assertOk()->assertJsonCount(10);
    }

    public function testCreate() {
        $data = [
            'name' => 'name',
            'address' => 'address',
            'location' => 'address',
            'latitude' => '-6.487795',
            'longitude' => '-76.370540',
            'icon' => $this->createFakeImg('icon.png'),
            'banner' => $this->createFakeImg('banner.png'),
            'start_time' => '08:00:00',
            'end_time' => '15:00:00',
        ];
        $response = $this->request
            ->withHeaders(['Content-Type' => 'multipart/form-data; boundary=<calculated when request is sent>'])
            ->post('/api/admin/stores', $data);
        $lastStore = Store::all()->last();
        $response->assertCreated()
            ->assertJson(function (AssertableJson $json) use ($lastStore) {
                $json->where('id', $lastStore->id)
                    ->where('name', $lastStore->name)
                    ->where('address', $lastStore->address)
                    ->where('location', $lastStore->location)
                    ->where('latitude', $lastStore->latitude)
                    ->where('longitude', $lastStore->longitude)
                    ->where('start_time', $lastStore->start_time)
                    ->where('end_time', $lastStore->end_time)
                    ->etc();
            });
        Storage::disk('public')->assertExists("uploads/{$lastStore->icon}");
        Storage::disk('public')->assertExists("uploads/{$lastStore->banner}");
    }

    public function testShow() {
        $store = $this->createProduct($this->userAuth);
        $response = $this->request->get("/api/admin/stores/" . $store->id);
        $response->assertOk()->assertJson($store->toArray());
    }

    public function testUpdate() {
        $store = $this->createProduct($this->userAuth);
        $data = [
            'name' => 'new name',
            'address' => 'new address',
            'location' => 'new address',
            'latitude' => -6.487795,
            'longitude' => -76.370540,
            'icon' => $this->createFakeImg('new_icon.png'),
            'banner' => $this->createFakeImg('new_banner.png'),
            'start_time' => '09:00:00',
            'end_time' => '16:00:00',
        ];
        $response = $this->request->put("/api/admin/stores/" . $store->id, $data);
        $response->assertNoContent();
        $lastStore = Store::find($store->id);
        $this->assertEquals($lastStore->name, $data['name']);
        $this->assertEquals($lastStore->address, $data['address']);
        $this->assertEquals($lastStore->location, $data['location']);
        $this->assertEquals($lastStore->latitude, $data['latitude']);
        $this->assertEquals($lastStore->longitude, $data['longitude']);
        $this->assertEquals($lastStore->start_time, $data['start_time']);
        $this->assertEquals($lastStore->end_time, $data['end_time']);
        Storage::disk('public')->assertExists("uploads/{$lastStore->icon}");
        Storage::disk('public')->assertExists("uploads/{$lastStore->banner}");
    }

    public function testDestroy() {
        $store = $this->createProduct($this->userAuth);
        $response = $this->request->delete("/api/admin/stores/" . $store->id);
        $response->assertNoContent();
        $this->assertSoftDeleted('stores', ['id' => $store->id]);
    }

    private function createProduct($user) {
        return Store::factory()->for($user)->create();
    }
}
