<?php

namespace Tests\Feature;

use App\Models\Store;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class StoreTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        Storage::fake('public');
        $this->userAuth = User::all()->first();
    }

    public function testList() {
        Store::factory(10)->create();
        $response = $this->actingAs($this->userAuth)->get('/api/stores');
        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function testCreate() {
        $data = [
            'name' => 'name',
            'address' => 'address',
            'location' => 'address',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'icon' => $this->createFakeImg('icon.jpeg'),
            'banner' => $this->createFakeImg('banner.jpeg'),
            'start_time' => '08:00:00',
            'end_time' => '15:00:00',
        ];
        $response = $this
            ->actingAs($this->userAuth)
            ->withHeaders(['Content-Type' => 'multipart/form-data; boundary=<calculated when request is sent>'])
            ->post('/api/stores', $data);
        $lastStore = Store::all()->last();
        $response->assertCreated()->assertJson($lastStore);
        Storage::disk('public')->assertExists("uploads/{$lastStore->icon}");
        Storage::disk('public')->assertExists("uploads/{$lastStore->banner}");
    }

    private function createFakeImg($name = 'fake_img.jpg'): UploadedFile {
        return UploadedFile::fake()->image($name);
    }

    public function testShow() {
        $store = Store::factory(1)->create();
        $response = $this->actingAs($this->userAuth)->get("/api/stores/" . $store[0]->id);
        $response->assertStatus(200)->assertJson($store[0]);
    }

    public function testUpdate() {
        $store = Store::factory(1)->create();
        $data = [
            'name' => 'new name',
            'address' => 'new address',
            'location' => 'new address',
            'latitude' => 'new latitude',
            'longitude' => 'new longitude',
            'icon' => $this->createFakeImg('new_icon.jpeg'),
            'banner' => $this->createFakeImg('new_banner.jpeg'),
            'start_time' => '09:00:00',
            'end_time' => '16:00:00',
        ];
        $response = $this->actingAs($this->userAuth)->put("/api/stores/" . $store[0]->id, $data);
        $response->assertStatus(200)->assertJson($store[0]);
    }

    public function tesDestroy() {
        $store = Store::factory(1)->create();
        $response = $this->actingAs($this->userAuth)->delete("/api/stores/" . $store[0]->id);
        $response->assertStatus(200);
    }
}
