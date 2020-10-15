<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['PHP', 'Programming', 'JavaScript', 'Life', 'Travel','Coffee', 'Money', 'Women', 'Men', 'Love' ]),
            'user_id'=>$this->faker->numberBetween(1,10),
            'team_id'=>$this->faker->numberBetween(1,3)
        ];
    }
}
