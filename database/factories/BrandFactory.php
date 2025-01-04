<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['battery', 'lubricant']),
            'brand_id' => $this->faker->unique()->uuid,
            'brand_name' => $this->faker->company,
            'image' => 'brands/bniPO9oeNjRxCpGLaX6mkuSbeWvVXYXdHRdadi25.png',
            'date' => $this->faker->date(),
        ];
    }
}