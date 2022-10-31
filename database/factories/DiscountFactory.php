<?php

namespace Database\Factories;
use App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dis_name'=>fake()->name(),
            'value'=>fake()->numerify(),
            'start_day'=>fake()->date("Y-m-d H:i:s"),
            'end_day'=>fake()->date("Y-m-d H:i:s"),
            'is_state'=>fake()->numberBetween($min = 0, $max = 1)
        ];
    }
}
