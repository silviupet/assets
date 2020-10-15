<?php

namespace Database\Factories;

use App\Models\Atribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Atribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,7),
            'description'=>$this->faker->sentence(7,11),
            'from_date'=>$this->faker->dateTimeBetween('-1year', 'now'),
            'expiry_date'=>$this->faker->dateTimeBetween('now', '+1year'),
            'price'=>$this->faker->numberBetween(1,1000),
            'currency'=>$this->faker->randomElement(['ron','eur', 'usd']),
            'vendor'=>$this->faker->company,
            'other_conditions'=>$this->faker->sentence(7,11),
            'user_id'=>$this->faker->numberBetween(1,10),
            'team_id'=>$this->faker->numberBetween(1,10)
        ];
    }
}
