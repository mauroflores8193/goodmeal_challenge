<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory {
    public function definition() {
        $deliveryTypes = ['shipping', 'pick_up'];
        $deliveryType = $deliveryTypes[array_rand($deliveryTypes)];
        return [
            'delivery_type' => $deliveryType,
            'delivery_date' => $this->faker->date('Y:m:d'),
            'shipping_cost' => $deliveryType == 'shipping' ? $this->faker->numberBetween(1000, 5000): null
        ];
    }
}
