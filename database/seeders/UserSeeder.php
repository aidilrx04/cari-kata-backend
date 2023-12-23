<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Grid;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->state([
            'username' => 'user1',
            'password' => Hash::make('123456')
        ])->has(Game::factory()->count(2)->hasGrid())->create();
        User::factory()->state([
            'username' => 'user2',
            'password' => Hash::make('123456')
        ])->has(Game::factory()->count(2)->hasGrid())->create();
        User::factory()->count(10)->has(Game::factory()->count(2)->has(Grid::factory()))->create();
    }
}
