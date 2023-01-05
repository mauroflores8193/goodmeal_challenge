<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderDetailFactory extends Factory {
    public function definition() {
        return [
            'amount' => $this->faker->numberBetween(1, 3),
            'price' =>  $this->faker->randomFloat(0, 100, 10000)
        ];
    }
}
