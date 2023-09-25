<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharacterScore>
 */
class CharacterScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    		
    		'ChampionId' => $this->faker->numberBetween(1, 165),
    		'UserId' => $this->faker->numberBetween(1, 11),
            'Score' => $this->faker->numberBetween(1,5),
            
	];
    }
}
