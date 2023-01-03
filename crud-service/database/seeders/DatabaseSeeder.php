<?php

namespace Database\Seeders;

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

        for($i = 0; $i < 5; $i++) {
            $userNew = User::factory()->create();
            for($j = 0; $j < rand(1, 5); $j++) {
                $storeNew = Store::factory()->for($userNew)->create();
                Product::factory(rand(1, 15))->for($userNew)->for($storeNew)->create();
            }
        }
    }
}
