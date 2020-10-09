<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $faker->randomElement(['contract', 'factura', 'polita', 'garantie' ]),
            'link'=> $this->facker->imageUrl($width = 640, $height = 480)
            'user_id'=>$this->faker->numberBetween(1,10),
            'team_id'=>$this->faker->numberBetween(1,3),
        ];
    }
}
