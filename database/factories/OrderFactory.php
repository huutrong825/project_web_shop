<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id'=>fake()->numberBetween($min=1, $max=20),
            'order_date'=>fake()->date("Y-m-d H:i:s"),
            'receive_date'=>fake()->date("Y-m-d H:i:s"),
            'cancel_date'=>fake()->date("Y-m-d H:i:s"),
            'type_payment' => fake()->numberBetween($min=1, $max=2),
            'total_price' =>fake()->numberBetween($min=200000, $max=900000),
            'description'=>fake()->sentence(50),
            'state'=>fake()->numberBetween($min=1, $max=6),
        ];
    }
}
