<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\Patient;
use Faker\Generator as Faker;


class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pesel' => $this->faker->numerify('###########'),
            'name' => $this->faker->firstName($gender = null),
            'lastname' => $this->faker->lastName,
            'birthday' => $this->faker->dateTimeBetween($startDate = '-80 years', $endDate = 'now', $timezone = null),
        ];
    }
}
