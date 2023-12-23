<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grid>
 */
class GridFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $grid = [];
        $rows = 9;

        for ($i = 0; $i < $rows; $i++) {
            $row = [];
            $count = 7;
            for ($j = 0; $j < $count; $j++) {
                array_push($row, $this->faker->randomLetter());
            }
            array_push($grid, $row);
        }

        return [
            "rows" => 9,
            "columns" => 7,
            "grid" => $grid,
            "solved" => [[], [], []],
        ];
    }
}
