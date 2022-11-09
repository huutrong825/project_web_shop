<?php

namespace Database\Factories;

use App\Models\Order_Detail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Order_DetailFactory extends Factory
{
    protected $model=Order_Detail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => fake()->numberBetween($min=1, $max=20),
            'product_id'=> fake()->numberBetween($min=1, $max=20),
            'quanity_order' => fake()->numberBetween($min=1, $max=10),
            'price' => fake()->numberBetween($min=200000, $max=900000),
            'discount'=> fake()->numberBetween($min=50000, $max=200000),
        ];
    }
}
