<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model=Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'supplier_name'=>fake()->company(),
            'phone'=>fake()->e164PhoneNumber(),
            'address'=>fake()->address(),
            'is_state'=>fake()->numberBetween($min=0,$max=1)
        ];
    }
}
