<?php

namespace Database\Factories;

use App\Models\Product_Img;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Product_ImgFactory extends Factory
{
    protected $model=Product_Img::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id'=>fake()->numberBetween($min=1,$max=20),
            'img_url'=>fake()->imageUrl($width=240,$height=320)
        ];
    }
}
