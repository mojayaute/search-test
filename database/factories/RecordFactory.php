<?php

namespace Database\Factories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'operation_id' => \App\Models\Operation::factory(),
            'user_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomFloat(2, 1, 100), // Generates a random float with 2 decimal places between 1 and 100
            'user_balance' => $this->faker->randomFloat(2, 0, 1000), // Generates a random float with 2 decimal places between 0 and 1000
            'operation_response' => $this->faker->word, // Generates a random word
            'date' => $this->faker->dateTime(), // Generates a random date and time
        ];
    }
}
