<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // factory(Item::class,30)->create();
        return [
            'user_id' => User::factory(),
            'title' => Str::random(10),
            'body' => Str::random(10),
        ];
    }
}
