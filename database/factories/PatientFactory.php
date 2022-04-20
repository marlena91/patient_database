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
            'name' => $this->faker->firstName($gender = null),
            'lastname' => $this->faker->lastName,
            'birthday' => $this->faker->dateTimeBetween($startDate = '-80 years', $endDate = 'now'),
            'pesel' => function (array $model) {
                $century = substr($model['birthday']->format('Y'), -4, 2);
                $justYear = substr($model['birthday']->format('Y'), -2);
                $justMonth = $model['birthday']->format('m');
                $justDay = $model['birthday']->format('d');
                if ($century == 18) {
                    $justMonth += 80;
                } else if ($century == 20) {
                    $justMonth += 20;
                } else if ($century == 21) {
                    $justMonth += 40;
                } else if ($century == 22) {
                    $justMonth += 60;
                }
                $firstPart = $justYear . $justMonth . $justDay;

                $secondPart = $this->faker->numerify('#####');

                return $firstPart . $secondPart;
            }
        ];
    }
}
