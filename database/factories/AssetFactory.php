<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,7),
            'category_id'=> $this->faker->numberBetween(1,10),
           'user_id' => $this->faker->numberBetween(1,10),
            'team_id' =>$this->faker->numberBetween(1,10)

        ];
    }
}
