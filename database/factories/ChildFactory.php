<?php

namespace Database\Factories;
use App\Models\Item;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'item_id' => Item::factory(),
        ];
    }
}
