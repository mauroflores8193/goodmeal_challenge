<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory {
    public function definition() {
        return [
            'name' => $this->faker->name(),
            'address' => 'address',
            'location' => 'location',
            'latitude' => $this->faker->randomFloat(10, -90,90),
            'longitude' => $this->faker->randomFloat(10, -180,180),
            'icon' => 'icon.png',
            'banner' => 'banner.png',
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'user_id' => User::all()->first()->id
        ];
    }
}
