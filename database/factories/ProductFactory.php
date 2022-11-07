<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model=Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'product_name'=>fake()->name(),
            // 'cate_id'=>fake()->numberBetween($min=1,$max=10),
            // 'quanity'=>fake()->numberBetween($min=100,$max=200),
            // 'unit_price'=>fake()->numberBetween($min=70000,$max=200000),
            // 'unit_id'=>fake()->numberBetween($min=1,$max=5),
            // 'description'=>fake()->sentence(100),
            // 'image'=>fake()->imageUrl($width=240,$height=320),
            // 'dis_id'=>fake()->numberBetween($min=1,$max=5),
            // 'sup_id'=>fake()->numberBetween($min=1,$max=5),
            // 'is_sale'=>fake()->numberBetween($min=0,$max=1),
            // 'is_delete'=>0,
            'product_name'=>fake()->name(),
            'category_id' => fake()->numberBetween($min=1, $max=10),
            'quanity' => fake()->numberBetween($min=100, $max=200),
            'unit_price' => fake()->numberBetween($min=70000, $max=200000),
            'unit' => fake()->numberBetween($min=1, $max=5),
            'description'=>fake()->sentence(100),
            'image' => fake()->imageUrl($width=240, $height=320),
            'discount'=>fake()->numberBetween($min=1, $max=5),
            'supplier_id' => fake()->numberBetween($min=1, $max=5),
            'is_sale' => fake()->numberBetween($min=0, $max=1),
        ];
    }
}
