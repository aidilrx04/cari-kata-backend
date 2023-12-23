<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Grid;
use Database\Factories\GridFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::factory()->count(15)->has(Grid::factory())->create();
    }
}
