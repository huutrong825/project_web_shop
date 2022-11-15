<?php

namespace Database\Factories;
use App\Models\Product_Add;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product_Add>
 */
class Product_AddFactory extends Factory
{
    protected $model=Product_Add::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pro_id' => fake()->numberBetween($min=1, $max=20),
            'quanity_add' => fake()->numberBetween($min=100, $max=200),
            'price' => fake()->numberBetween($min=70000, $max=200000),
            'date_add' =>fake()->date("Y-m-d H:i:s"),
        ];
    }
}
