<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CharactersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    		'id' => $this->faker->number(),
    		'name' => $this->faker->text(),
    		'lane' => $this->faker->text(),
            'shop-cost' => $this->faker->number(),
    		'difficulty' => $this->faker->text(),
            
	];

    }
}
