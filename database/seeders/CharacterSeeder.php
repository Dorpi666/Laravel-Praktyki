<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::create([
            'name' => 'Bard',
            'role' => 'Support (dla mainów: Każda)',
            'lane' => 'Bot (dla mainów: Każda)',
            'shop-cost' => '6300',
            'difficulty' => '5',
        ]);
    }
}
