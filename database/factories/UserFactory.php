<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model=User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->safeEmail(),
            'password'=>Hash::make('Admin'),
            'is_active'=>fake()->numberBetween($min = 0, $max = 1),
            'group_role'=>fake()->numberBetween($min = 1, $max = 2),
            'last_login_at'=>date('Y-m-d H:i:s'),
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d"),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
