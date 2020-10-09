<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $faker->randomElement(['PHP', 'Programming', 'JavaScript', 'Life', 'Travel','Coffee', 'Money', 'Women', 'Men', 'Love' ]),
            'user_id'=>$this->faker->numberBetween(1,10),
            'team_id'=>$this->faker->numberBetween(1,3),
        ];
    }
}
