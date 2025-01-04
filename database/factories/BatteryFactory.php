<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Battery>
 */
class BatteryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'model_name' => $this->faker->name,
            'brand_id' => Brand::where('type', 'battery')->inRandomOrder()->value('id'),
            'capacity' => $this->faker->randomNumber(2),
            'voltage' => $this->faker->randomElement(['12V', '24V', '36V', '48V']),
            'type' => $this->faker->randomElement(['Lead-Acid', 'Lithium-ion']),
            'purchase_price' => $this->faker->randomFloat(2, 500, 5000),
            'selling_price' => $this->faker->randomFloat(2, 500, 5000),
            'warranty_period' => $this->faker->randomNumber(2),
            'manufacturing_date' => $this->faker->date(),
            'expiry_date' => $this->faker->date(),
            'stock_quantity' => $this->faker->randomNumber(2),
            'added_date' => $this->faker->date(),
            'image' => 'batteries/okJH5to5uEKyTzB47WFRLoe2G2TPsprQ4C1VJNPt.png',

        ];
    }
}