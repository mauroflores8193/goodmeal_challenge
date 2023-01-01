<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    public function definition() {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'discount' => $this->faker->numberBetween(0, 50),
            'amount' => $this->faker->numberBetween(0, 200),
            'image' => 'image.png'
        ];
    }
}
