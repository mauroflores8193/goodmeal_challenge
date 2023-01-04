<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $user = new User();
        $user->email = 'mflores@gmail.com';
        $user->name = 'Mauro Flores';
        $user->password = Hash::make('password');
        $user->save();

        $client = User::factory()->create();
        $buyersCount = 5;
        for ($i = 0; $i < $buyersCount; $i++) {
            $userNew = User::factory()->create();

            $maxStoresByBuyer = 5;
            for ($j = 0; $j < rand(1, $maxStoresByBuyer); $j++) {
                $maxProductsByStore = 15;
                $store = Store::factory()
                    ->for($userNew)
                    ->has(Product::factory()->for($userNew)->count(rand(1, $maxProductsByStore)))
                    ->create();

                $maxOrdersByStore = 5;
                for ($k = 0; $k < rand(0, $maxOrdersByStore); $k++) {
                    $product = $store->products()->first();
                    $order = Order::factory()->for($store)->for($client)->create();
                    OrderDetail::factory()->for($product)->for($order)->create();
                }
            }
        }
    }
}
