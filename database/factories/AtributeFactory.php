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
            'name' => $this->faker->name,
            'description'=>$faker->sentence(7,11),
            'from_date'=>$faker->date->between("2015-01-01", "2019-12-31");
            'expiry_date'=>$faker->date->between("2020-01-01", "2022-12-31");
            'price'=>$this->faker->numberBetween(1,1000),
            'vendor'=>$this->faker->company;
            'other_condition'=>$this->facker->sentence(7,11),
            'user_id'=>$this->faker->numberBetween(1,10),
            'team_id'=>$this->faker->numberBetween(1,3)
        ];
    }
}
