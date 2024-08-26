<?php

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([
                'addition', 'subtraction', 'multiplication', 'division', 'square_root', 'random_string'
            ]),
            'cost' => $this->faker->randomFloat(2, 1, 10),
        ];
    }
}
